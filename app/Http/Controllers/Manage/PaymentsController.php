<?php

namespace App\Http\Controllers\Manage;

use App\Models\Account;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Providers\AppServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Morilog\Jalali\jDate;


class PaymentsController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['payments' , trans('manage.modules.payments')];
	}

	public function search(Requests\Manage\PaymentSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("forms.button.search") , "search"] ;
		$db = new Payment();

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = Payment::selector("search:$keyword")->orderBy('created_at' , 'desc')->paginate(50);
			return view('manage.payments.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.payments.search" , compact('page' , 'db'));

	}


	public function browse($master = 'all'  , $request_tab = null)
	{
		$page = $this->page ;
		$user_id = $order_id = 0 ;

		//request_tab...
		if(!$request_tab) {
			if($master=='all')
				$request_tab ='pending' ;
			else
				$request_tab = 'all' ;
		}

		//Master...
		if(str_contains($master,'customer')) {
			$customer = User::findCustomer( str_replace('customer' , null , $master) , true ) ;
			if(!$customer)
				return view('errors.410');
			$master_name = $customer->full_name ;
			$user_id = $customer->id ;
			$page[1] = ["browse/$master/$request_tab" , $master_name , "payments/browse/$master"] ;
		}
		elseif(str_contains($master,'order')) {
			$order = Order::withTrashed()->find( str_replace('order' , null , $master) ) ;
			if(!$order)
				return view('errors.410');
			$master_name = trans('validation.attributes.order_id').' '.AppServiceProvider::pd($order->slug) ;
			$order_id = $order->id ;
			$page[1] = ["browse/$master/$request_tab" , $master_name , "payments/browse/$master"] ;
		}
		elseif($master=='all') {
			$page[1] = ["browse/all/$request_tab" , trans('payments.all') , "payments/browse/$master"] ;
		}
		else {
			return view('errors.404');
		}

		//Preparation...
		$page[2] = ["browse/$master/$request_tab" , trans("payments.status.$request_tab") , "payments/browse/$master/$request_tab"] ;

		//Permissions...
		switch($request_tab) {
			case 'bin' :
				$permit = 'bin';
				break;

			default:
				$permit = '*' ;
		}
		if(!Auth::user()->can("payments.$permit"))
			return view('errors.403');

		//Model...
		$model_data = Payment::selector($request_tab , $user_id , $order_id)->orderby('created_at' , 'desc')->paginate(50);
		$db = new Payment() ;

		//View...
		return view("manage.payments.browse" , compact('page','model_data' , 'db' , 'master' , 'user_id' , 'order_id'));

	}

	public function update($model_id)
	{
		$model = Payment::withTrashed()->find($model_id);
		$counter = true ;
		if(!$model)
			return view('errors.m410');

		$model->spreadMeta() ;
		return view('manage.payments.browse-row' , compact('model' , 'counter'));
	}

	public function modalActions($item_id , $view_file)
	{
		if($item_id==0)
			return $this->modalBulkAction($view_file);

		$opt = [] ;

		//Model...
		if(str_contains($item_id , 'n')) {
			$item_id = intval($item_id) ;
		}
		else {
			$model = Payment::withTrashed()->find($item_id);
			if(!$model)
				return view('errors.m410');
		}

		//Permission...
		$permit = 'payments' ;

		switch($view_file) {
			case 'soft_delete' :
				$permit .= '.delete' ;
				break;

			case 'undelete' :
			case 'hard_delete' :
				$permit .= '.bin' ;
				break;

			case 'process' :
				$model->spreadMeta();
				$model->view_only = true ;
				$permit .= '.process' ;
				break;

			default:
				dd("modalAction:$view_file: $item_id");
		}

		if(!Auth::user()->can($permit))
			return view('errors.m403');

		//View...
		$view = "manage.payments.$view_file" ;
		if(!View::exists($view)) return view('errors.m404');
		return view($view , compact('model' , 'opt')) ;
	}

	public function create($order_id = 0)
	{
//		$order_id = 1 ; //@TODO: Remove This!
		//Permission...
		if(!Auth::user()->can('payments.create'))
			return view('errors.m403');

		//Model...
		$model = new Payment() ;
		$model->order_id = $order_id ;
		$model->user_id = 0 ;


		//Product...
		if($order_id>0) {
			$order = Order::selector('live')->where('id' , $order_id)->first() ;
			if(!$order)
				return view('errors.m410');
			$model->order_id = $order->id ;
			$model->user_id = $order->user_id ;
			$model->amount_declared = $order->amount_payable ;

			if($model->order->direction == 'outcome')
				$model->method  = $model->default_method_for_outcome;
			else
				$model->method  =$model->default_method_for_income;

			return view('manage.payments.editor' , compact('model'));
		}
		else {
			return view('manage.payments.create');
		}

	}

	public function editor($model_id)
	{
		//Model...
		$model = Payment::withTrashed()->find($model_id);
		if(!$model)
			return view('errors.m410');

		$model->spreadMeta() ;

		//View...
		return view( 'manage.payments.editor', compact('model'));
	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function createAction(Requests\Manage\PaymentCreateRequest $request)
	{
		//Find...
		$order = Order::findBySlug($request->order_no) ;

		//Validation...
		if(!$order)
			return $this->jsonFeedback(trans('validation.http.Error410'));

		if($order->amount_invoiced <= $order->amount_paid )
			return $this->jsonFeedback(trans('orders.form.order_already_paid'));

		//Feedback...
		return $this->jsonFeedback([
				'ok' => 1 ,
				'callback' => 'masterModal("'. url('manage/payments/create/'.$order->id) . '") ',
				'message' => trans('payments.form.feedback_order_next_step') ,
				'redirectTime' => "1",
		]);



	}

	public function save(Requests\Manage\PaymentSaveRequest $request)
	{
		$data = $request->toArray() ;

		/*--------------------------------------------------------------------------
		| Validations and Normalizations
		*/

		if($request->id) {
			$model = Payment::find($request->id);
			unset($data['payment_method']);
			unset($data['amount_declared']);
			$data['status'] = '-' ;
			if(!$model) {
				return $this->jsonFeedback(trans('validation.http.Error410'));
			}
			if(!$model->canSave()) {
				return $this->jsonFeedback(trans('validation.http.Error403'));
			}
		}
		else {
			if(!Auth::user()->can('payments.process'))
				$data['status'] = 'pending' ;
		}

		if(in_array($request->payment_method , ['cash','shetab','transfer','deposit','pos'])) {
			$data['payment_date'] = $request->payment_date . ' ' . $request->payment_time;
		}

		if($request->direction == 'outcome' and in_array($request->payment_method,['shetab','transfer','deposit','cheque'])) {
			$account = Account::where('id' , $request->customer_account_id )->where('user_id' , $request->user_id)->first();
			if(!$account) {
				return $this->jsonFeedback(trans('validation.exists') , ['attribute' => trans('validation.attributes.customer_account_id'),]);
			}
		}

		if($request->direction == 'income' and $request->payment_method=='site_credit' and $request->amount_declared > $request->site_credit){
			return $this->jsonFeedback(trans('payments.form.insufficient_credit'));
		}

		if($data['status']=='confirmed') {
			$data['amount_confirmed'] = $data['amount_declared'] ;
			$data['checked_at'] = Carbon::now()->toDateTimeString() ;
			$data['checked_by'] = Auth::user()->id ;
		}

		/*--------------------------------------------------------------------------
		| Save
		*/

		$saved = Payment::store($data , ['payment_time' , 'amount_payable' , 'site_credit' , 'status']);

		if($saved and $data['status']=='confirmed') {
			$model = Payment::find($saved);
			$model->reindex() ;
		}

		/*--------------------------------------------------------------------------
		| Return ...
		*/

		return $this->jsonAjaxSaveFeedback($saved , [
				'success_callback' => "rowUpdate('tblPayments','$request->id')",
		]);

	}

	public function process(Requests\Manage\PaymentProcessRequest $request)
	{
		$data = [] ;

		/*--------------------------------------------------------------------------
		| Validations and Normalizations
		*/

		$model = Payment::find($request->id);
		if(!$model) {
			return $this->jsonFeedback(trans('validation.http.Error410'));
		}

		if($model->direction == 'income' and $model->payment_method=='site_credit' and $request->amount_confirmed > $model->user->site_credit){
			return $this->jsonFeedback(trans('payments.form.insufficient_credit'));
		}

		/*--------------------------------------------------------------------------
		| Save ...
		*/

		$saved = Payment::store( [
			'id' => $request->id,
			'amount_confirmed' => $request->amount_confirmed,
			'checked_at' => Carbon::now()->toDateTimeString(),
			'checked_by' => Auth::user()->id,
		] );
		if($saved)
			$model->reindex() ;

		/*--------------------------------------------------------------------------
		| Return ...
		*/

		return $this->jsonAjaxSaveFeedback($saved , [
				'success_callback' => "rowUpdate('tblPayments','$request->id')",
		]);



	}

	public function soft_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('payments.delete'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		//Delete...
		$done = Payment::destroy($request->id);
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblPayments','$request->id')",
		]);

	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('payments.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Payment::onlyTrashed()->where('id', $request->id)->restore();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblPayments','$request->id')",
		]);


	}

	public function hard_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('payments.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Payment::onlyTrashed()->where('id',$request->id)->forceDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblPayments','$request->id')",
		]);

	}


}

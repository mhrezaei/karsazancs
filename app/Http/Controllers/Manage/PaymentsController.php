<?php

namespace App\Http\Controllers\Manage;

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


	public function browse($master = 'all'  , $request_tab = 'open')
	{
		$page = $this->page ;
		$user_id = $product_id = 0 ;

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
			$master_name = $order->title ;
			$product_id = $order->id ;
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
		$model_data = Payment::selector($request_tab , $user_id , $product_id)->orderby('created_at' , 'desc')->paginate(50);
		$db = new Payment() ;

		//View...
		return view("manage.payments.browse" , compact('page','model_data' , 'db' , 'master' , 'user_id' , 'product_id'));

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

			default:
				dd("$view_file: $item_id");
		}

		if(!Auth::user()->can($permit))
			return view('errors.m403');

		//View...
		$view = "manage.payments.$view_file" ;
		if(!View::exists($view)) return view('errors.m404');
		return view($view , compact('model' , 'opt')) ;
	}

	public function create($product_id = 0 , $user_id = 0)
	{
		//Permission...
		if(!Auth::user()->can('payments.create'))
			return view('errors.m403');

		//Model...
		$model = new Payment() ;
		$model->user_id = $user_id ;
		$model->product_id = $product_id ;

		//User...
		if($user_id>0) {
			$customer = User::selector()->where('id' , $user_id)->first() ;
			if(!$customer)
				return view('errors.m410');
			$model->user_id = $customer->id ;
		}

		//Product...
		if($product_id>0) {
			$product = Product::selector('all')->where('id' , $product_id)->first() ;
			if(!$product)
				return view('errors.m410');
			$model->product_id = $product->id ;
		}
		else {
			$products = Product::selector('all')->orderBy('title')->get() ;
		}

		//Full Form...
		if($product_id * $user_id > 0) {
			$model->initial_charge = $model->product->initial_charge ;
			$model->product->spreadMeta() ;
			$model->status = 2 ;
			$model->rate = $model->product->currency()->loadCurrentRates()->price_to_sell ;
		}

		//View...
		if($product_id * $user_id == 0)
			return view('manage.payments.create' , compact('model' , 'products'));
		else
			return view('manage.payments.editor-new' , compact('model')); ;
	}

	public function editor($model_id=0)
	{
		//Model...
		$model = Payment::withTrashed()->find($model_id);
		if(!$model)
			return view('errors.m410');

		$model->spreadMeta();
		$model->product->spreadMeta() ;

		if($model->canEdit())
			$model->rate = $model->product->currency()->loadCurrentRates()->price_to_sell ;
		else
			$model->rate = $model->product->currency()->loadRates($model->created_at)->price_to_sell ;


		//View...
		return view( 'manage.payments.editor-new', compact('model'));
	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function createAction(Requests\Manage\PaymentCreateRequest $request)
	{

		//Customer...
		if($request->user_id > 0) {
			$customer = User::selector()->where('id' , $request->user_id)->first() ;
		}
		else {
			$customer = User::selector()->where('code_melli' , $request->code_melli)->first() ;

		}
		if(!$customer)
			return $this->jsonFeedback(trans('forms.feed.user_not_found'));

		//Product...
		$product = Product::selector('all')->where('id' , $request->product_id)->first() ;
		if(!$product)
			return $this->jsonFeedback(trans('forms.feed.thing_not_found' , ['thing' => trans('validation.attributes.product'),]));

		//Feedback...
		return $this->jsonFeedback([
				'ok' => 1 ,
				'callback' => 'masterModal("'. url('manage/payments/create/'.$product->id.'/'.$customer->id) . '") ',
				'message' => trans('payments.form.feedback_order_next_step') ,
				'redirectTime' => "1",
		]);



	}

	public function saveNew(Requests\Manage\PaymentNewRequest $request)
	{
		$data = $request ;

		//Validation
		if($request->id) {
			$model = Payment::find($request->id);
			if(!$model or $model->type != 'new')
				return $this->jsonFeedback(trans('validation.http.Error410'));
			if(!$model->canEdit())
				return $this->jsonFeedback(trans('validation.http.Error403'));
		}
		else {
			$model = new Payment();
			$model->product_id = $request->product_id ;
			$model->type = 'new' ;
		}

		$customer = User::selector()->where('id' , $request->user_id)->first() ;
		if(!$customer)
			return $this->jsonFeedback(trans('forms.feed.user_not_found'));

		$product = Product::selector('all')->where('id' , $request->product_id)->first() ;
		if(!$product)
			return $this->jsonFeedback(trans('forms.feed.thing_not_found' , ['thing' => trans('validation.attributes.product'),]));
		$product->spreadMeta() ;

		if($request->initial_charge < $product->min_charge)
			return $this->jsonFeedback(trans('products.form.error_charge_less_than_min'));

		if($request->initial_charge > $product->max_charge and $product->max_charge > 0)
			return $this->jsonFeedback(trans('products.form.error_charge_more_than_max'));


		//Other Data... ()
		if(!$model->canProcess() or !$request->status or $request->status>3)
			if($model->id)
				unset($data['status']);
			else
				$data['status'] = 1 ;

		$data['rate'] = $model->product->currency()->loadCurrentRates()->price_to_sell ;
		$data['original_invoice'] = round($data['rate'] * $request->initial_charge);

		//Save...
		$saved = Payment::store($data);

		//Feedback...
		return $this->jsonAjaxSaveFeedback($saved , [
				'success_callback' => "rowUpdate('tblPayments','$request->id')",
		]);
	}

	public function save(Requests\Manage\PaymentSaveRequest $request)
	{
		//More Validations...
		if($request->charge > 0 and $request->min_charge > 0 and $request->charge < $request->min_charge)
			return $this->jsonFeedback(trans('payments.form.error_charge_less_than_min'));
		if($request->charge > 0 and $request->max_charge > 0 and $request->charge > $request->max_charge)
			return $this->jsonFeedback(trans('payments.form.error_charge_less_than_min'));
		if($request->min_charge > 0 and $request->max_charge > 0 and $request->min_charge > $request->max_charge)
			return $this->jsonFeedback(trans('payments.form.error_min_more_than_max'));

		if($request->inventory > 0 and $request->inventory_low_alarm < $request->inventory_low_action )
			return $this->jsonFeedback(trans('payments.form.error_alarm_less_than_action'));

		//Save and Return...
		$saved = Payment::store($request);

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

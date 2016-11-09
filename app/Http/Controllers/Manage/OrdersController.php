<?php

namespace App\Http\Controllers\Manage;

use App\Models\Order;
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


class OrdersController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['orders' , trans('manage.modules.orders')];
	}

	public function search(Requests\Manage\OrderSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("forms.button.search") , "search"] ;
		$db = new Order();

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = Order::selector("search:$keyword")->orderBy('created_at' , 'desc')->paginate(50);
			return view('manage.orders.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.orders.search" , compact('page' , 'db'));

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
			$page[1] = ["browse/$master/$request_tab" , $master_name , "orders/browse/$master"] ;
		}
		elseif(str_contains($master,'product')) {
			$product = Product::withTrashed()->find( str_replace('product' , null , $master) ) ;
			if(!$product)
				return view('errors.410');
			$master_name = $product->title ;
			$product_id = $product->id ;
			$page[1] = ["browse/$master/$request_tab" , $master_name , "orders/browse/$master"] ;
		}
		elseif($master=='all') {
			$page[1] = ["browse/all/$request_tab" , trans('orders.all') , "orders/browse/$master"] ;
		}
		else {
			return view('errors.404');
		}

		//Preparation...
		$page[2] = ["browse/$master/$request_tab" , trans("orders.status.$request_tab") , "orders/browse/$master/$request_tab"] ;

		//Permissions...
		switch($request_tab) {
			case 'bin' :
				$permit = 'bin';
				break;

			default:
				$permit = '*' ;
		}
		if(!Auth::user()->can("orders.$permit"))
			return view('errors.403');

		//Model...
		$model_data = Order::selector($request_tab , $user_id , $product_id)->orderby('created_at' , 'desc')->paginate(50);
		$db = new Order() ;

		//View...
		return view("manage.orders.browse" , compact('page','model_data' , 'db' , 'master' , 'user_id' , 'product_id'));

	}

	public function update($model_id)
	{
		$model = Order::withTrashed()->find($model_id);
		$counter = true ;
		if(!$model)
			return view('errors.m410');

		$model->spreadMeta() ;
		return view('manage.orders.browse-row' , compact('model' , 'counter'));
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
			$model = Order::withTrashed()->find($item_id);
			if(!$model)
				return view('errors.m410');
		}

		//Permission...
		$permit = 'orders' ;

		switch($view_file) {
			case 'query' :
				break ;

			case 'history' :
				$page = $this->page ;
				$page[1] = [null , $model->title , ' '] ;
				$page[2] = [null , trans('orders.price_history')] ;
				$model_data = $model->rates()->orderBy('effective_date' , 'desc')->paginate(50) ;
				break ;

			case 'update' :
				$permit .= '.process' ;
				break ;

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
		$view = "manage.orders.$view_file" ;
		if(!View::exists($view)) return view('errors.m404');
		return view($view , compact('model' , 'opt' , 'page' , 'model_data')) ;
	}


	public function editor($model_id=0)
	{
		//Model...
		if($model_id) {
			$permit = 'orders' ;
			$model = Order::withTrashed()->find($model_id);
			$model->spreadMeta();
		}
		else {
			$permit = 'orders.create' ;
			$model = new Order();
			$model->currency = 'EUR' ;
		}

		//Permission...
		if(!Auth::user()->can($permit))
			return view('errors.403');

		//View...
		return view( 'manage.orders.editor', compact('model'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\OrderSaveRequest $request)
	{
		//More Validations...
		if($request->charge > 0 and $request->min_charge > 0 and $request->charge < $request->min_charge)
			return $this->jsonFeedback(trans('orders.form.error_charge_less_than_min'));
		if($request->charge > 0 and $request->max_charge > 0 and $request->charge > $request->max_charge)
			return $this->jsonFeedback(trans('orders.form.error_charge_less_than_min'));
		if($request->min_charge > 0 and $request->max_charge > 0 and $request->min_charge > $request->max_charge)
			return $this->jsonFeedback(trans('orders.form.error_min_more_than_max'));

		if($request->inventory > 0 and $request->inventory_low_alarm < $request->inventory_low_action )
			return $this->jsonFeedback(trans('orders.form.error_alarm_less_than_action'));

		//Save and Return...
		$saved = Order::store($request);

		return $this->jsonAjaxSaveFeedback($saved , [
				'success_callback' => "rowUpdate('tblOrders','$request->id')",
		]);

	}

	public function soft_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('orders.delete'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		//Delete...
		$done = Order::destroy($request->id);
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblOrders','$request->id')",
		]);

	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('orders.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Order::onlyTrashed()->where('id', $request->id)->restore();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblOrders','$request->id')",
		]);


	}

	public function hard_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('orders.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Order::onlyTrashed()->where('id',$request->id)->forceDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblOrders','$request->id')",
		]);

	}


}

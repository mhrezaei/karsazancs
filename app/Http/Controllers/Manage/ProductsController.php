<?php

namespace App\Http\Controllers\Manage;

use App\Models\Product;
use App\Providers\AppServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Morilog\Jalali\jDate;


class ProductsController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['products' , trans('manage.modules.products')];
	}

	public function search(Requests\Manage\ProductSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("forms.button.search") , "search"] ;
		$db = new Product();

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = Product::selector("search:$keyword")->orderBy('created_at' , 'desc')->paginate(50);
			return view('manage.products.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.products.search" , compact('page' , 'db'));

	}


	public function browse($request_tab = 'all')
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["browse/".$request_tab , trans("products.status.$request_tab") , $request_tab] ;

		//Permissions...
		switch($request_tab) {
			case 'bin' :
				$permit = 'bin';
				break;

			default:
				$permit = '*' ;
		}
		if(!Auth::user()->can("products.$permit"))
			return view('errors.403');

		//Model...
		$model_data = Product::selector($request_tab)->orderby('title')->paginate(50);
		$db = new Product() ;

		//View...
		return view("manage.products.browse" , compact('page','model_data' , 'db'));

	}

	public function update($model_id)
	{
		$model = Product::withTrashed()->find($model_id);
		$counter = true ;
		if(!$model)
			return view('errors.m410');

		$model->spreadMeta() ;
		return view('manage.products.browse-row' , compact('model' , 'counter'));
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
			$model = Product::withTrashed()->find($item_id);
			if(!$model)
				return view('errors.m410');
		}

		//Permission...
		$permit = 'products' ;

		switch($view_file) {
			case 'query' :
				break ;

			case 'history' :
				$page = $this->page ;
				$page[1] = [null , $model->title , ' '] ;
				$page[2] = [null , trans('products.price_history')] ;
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
		$view = "manage.products.$view_file" ;
		if(!View::exists($view)) return view('errors.m404');
		return view($view , compact('model' , 'opt' , 'page' , 'model_data')) ;
	}


	public function editor($model_id=0 , $locked=0)
	{
		//Model...
		if($model_id) {
			$permit = 'products' ;
			$model = Product::withTrashed()->find($model_id);
			$model->spreadMeta();
			$model->locked = $locked ;
		}
		else {
			$permit = 'products.create' ;
			$model = new Product();
			$model->currency = 'EUR' ;
		}

		//Permission...
		if(!Auth::user()->can($permit))
			return view('errors.403');

		//View...
		return view( 'manage.products.editor', compact('model'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\ProductSaveRequest $request)
	{
		//More Validations...
		if($request->initial_charge > 0 and $request->min_charge > 0 and $request->initial_charge < $request->min_charge)
			return $this->jsonFeedback(trans('products.form.error_charge_less_than_min'));
		if($request->initial_charge > 0 and $request->max_charge > 0 and $request->initial_charge > $request->max_charge)
			return $this->jsonFeedback(trans('products.form.error_charge_less_than_min'));
		if($request->min_charge > 0 and $request->max_charge > 0 and $request->min_charge > $request->max_charge)
			return $this->jsonFeedback(trans('products.form.error_min_more_than_max'));

		if($request->inventory > 0 and $request->inventory_low_alarm < $request->inventory_low_action )
			return $this->jsonFeedback(trans('products.form.error_alarm_less_than_action'));

		//Save and Return...
		$saved = Product::store($request);

		return $this->jsonAjaxSaveFeedback($saved , [
				'success_callback' => "rowUpdate('tblProducts','$request->id')",
		]);

	}

	public function soft_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('products.delete'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		//Delete...
		$done = Product::destroy($request->id);
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblProducts','$request->id')",
		]);

	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('products.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Product::onlyTrashed()->where('id', $request->id)->restore();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblProducts','$request->id')",
		]);


	}

	public function hard_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('products.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Product::onlyTrashed()->where('id',$request->id)->forceDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblProducts','$request->id')",
		]);

	}


}

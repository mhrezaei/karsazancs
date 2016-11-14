<?php

namespace App\Http\Controllers\Manage;

use App\Models\Account;
use App\models\Branch;
use App\Models\Currency;
use App\Models\Rate;
use App\Models\State;
use App\Models\User;
use App\Providers\AppServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Morilog\Jalali\jDate;


class CurrenciesController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['currencies' , trans('manage.modules.currencies')];
	}

	public function search(Requests\Manage\CurrencySearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("forms.button.search") , "search"] ;
		$db = new Currency();

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = Currency::selector("search:$keyword")->orderBy('created_at' , 'desc')->paginate(50);
			return view('manage.currencies.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.currencies.search" , compact('page' , 'db'));

	}


	public function browse($request_tab = 'actives')
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["browse/".$request_tab , trans("currencies.status.$request_tab") , $request_tab] ;

		//Permissions...
		switch($request_tab) {
			case 'bin' :
				$permit = 'bin';
				break;
			default:
				$permit = '*' ;
		}
		if(!Auth::user()->can("currencies.$permit"))
			return view('errors.403');

		//Model...
		$model_data = Currency::selector($request_tab)->orderby('title')->paginate(50);
		$db = new Currency() ;

		//View...
		return view("manage.currencies.browse" , compact('page','model_data' , 'db'));

	}

	public function update($model_id)
	{
		$model = Currency::withTrashed()->find($model_id);
		$selector = true ;
		if(!$model)
			return view('errors.m410');
		else
			return view('manage.currencies.browse-row' , compact('model' , 'selector'));
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
			$model = Currency::withTrashed()->find($item_id);
			if(!$model)
				return view('errors.m410');
		}

		//Permission...
		$permit = 'currencies' ;

		switch($view_file) {
			case 'query' :
				break ;

			case 'history' :
				$page = $this->page ;
				$page[1] = [null , $model->title , ' '] ;
				$page[2] = [null , trans('currencies.price_history')] ;
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
		$view = "manage.currencies.$view_file" ;
		if(!View::exists($view)) return view('errors.m404');
		return view($view , compact('model' , 'opt' , 'page' , 'model_data')) ;
	}


	public function editor($model_id=0)
	{
		//Model...
		if($model_id) {
			$permit = 'currencies.edit' ;
			$model = Currency::find($model_id);
			$model->spreadMeta();
		}
		else {
			$permit = 'currencies.create' ;
			$model = new Currency();
		}

		//Permission...
		if(!Auth::user()->can($permit))
			return view('errors.403');

		//View...
		return view( 'manage.currencies.editor', compact('model'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\CurrencySaveRequest $request)
	{
		//Preparations...
		$data = $request->toArray() ;
		$data['title'] = $data['currency_title'] ;
		$data['slug'] = $data['currency_slug'] ;

		//Save and Return...
		$saved = Currency::store($data , ['currency_title' , 'currency_slug']);

		return $this->jsonAjaxSaveFeedback($saved , [
				'success_callback' => "rowUpdate('tblCurrencies','$request->id')",
		]);

	}

	public function soft_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('currencies.delete'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		//Delete...
		$done = Currency::destroy($request->id);
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblCurrencies','$request->id')",
		]);

	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('currencies.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Currency::onlyTrashed()->where('id', $request->id)->restore();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblCurrencies','$request->id')",
		]);


	}

	public function hard_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('currencies.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = Currency::onlyTrashed()->where('id',$request->id)->forceDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblCurrencies','$request->id')",
		]);

	}

	public function query(Requests\Manage\CurrencyQueryRequest $request)
	{
		$currency = Currency::find($request->currency_id) ;
		if(!$currency)
			return $this->jsonFeedback(trans('validation.http.Error410'));

		$rate = $currency->loadRates($request->date . ' ' . $request->time) ;


		if(!$rate->id)
			return $this->jsonFeedback(trans('currencies.query_failed'));
		else
			return $this->jsonFeedback([
				'ok' => 1 ,
				'message' => trans('currencies.query_result' , [
					'buy' => AppServiceProvider::pd(number_format($rate->price_to_buy)) ,
					'sell' => AppServiceProvider::pd(number_format($rate->price_to_sell)) ,
					'effective' => AppServiceProvider::pd(jDate::forge($rate->effective_date)->format('j F Y [H:m]')),
					'user' => $rate->user->full_name ,
					'date' => AppServiceProvider::pd(jDate::forge($rate->created_at)->format('j F Y [H:m]')),
				]) ,
			]);



	}

	public function updateRate(Requests\Manage\CurrencyUpdateRequest $request)
	{
		$data = $request->toArray() ;
		$data['id'] = 0 ;
		if($request->effective_date == 'custom') {
			$data['effective_date'] = Carbon::createFromFormat('Y/m/d H:i' , $request->date . ' ' . $request->time)->toDateTimeString() ;
		}
		else {
			$data['effective_date'] = Carbon::now()->toDateTimeString() ;
		}

		$ok = Rate::store($data , [ 'date' , 'time']);
		return $this->jsonAjaxSaveFeedback($ok , [
				'success_callback' => "rowUpdate('tblCurrencies','".$data['currency_id']."');rowUpdate('tblHistory','0');",
		]);
	}

}

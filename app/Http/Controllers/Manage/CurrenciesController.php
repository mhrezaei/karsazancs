<?php

namespace App\Http\Controllers\Manage;

use App\Models\Account;
use App\models\Branch;
use App\Models\Currency;
use App\Models\State;
use App\Models\User;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;


class CurrenciesController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['currencies' , trans('manage.modules.currencies')];
	}

	public function search(Requests\Manage\CustomerSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("forms.button.search") , "search"] ;
		$db = new User();

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = User::selector('customers' ,"search_customer:$keyword")->orderBy('created_at' , 'desc')->paginate(50);
			return view('manage.customers.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.customers.search" , compact('page' , 'db'));

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
				$permit = 'any' ;
		}
		if(!Auth::user()->can("currencies.$permit"))
			return view('errors.403');

		//Model...
		$model_data = Currency::selector($request_tab)->orderby('title')->paginate(50);
		$db = new Currency() ;

		//View...
		return view("manage.currencies.browse" , compact('page','model_data' , 'db'));

	}

	public function modalActions($user_id , $view_file)
	{
		if($user_id==0)
			return $this->modalBulkAction($view_file);

		$opt = [] ;

		//Model...
		if(str_contains($user_id , 'n')) {
			$user_id = intval($user_id) ;
		}
		else {
			$model = User::findCustomer($user_id, in_array($view_file, ['undelete', 'hard_delete']) ? true : false);
			if(!$model)
				return view('errors.m410');
		}

		//Permission...
		$permit = 'customers' ;

		switch($view_file) {
			case 'change_password' :
				$permit .= '.edit' ;
				break;

			case 'soft_delete' :
				$permit .= '.delete' ;
				break;

			case 'accounts' :
				$page = $this->page ;
				$page[1] = [null , trans('people.commands.bank_accounts').' '. $model->full_name , ' '] ;
				$model_data = $model->accounts()->paginate(50) ;
				break ;

			case 'new_account' :
				$permit .= 'edit' ;
				$view_file = 'accounts-editor' ;
				$user = $model ;
				$model = new User() ;
				$model->user_id = $user->id ;
				$model->user_name = $user->full_name ;
				break ;

			case 'edit_account' :
				$permit .= 'edit' ;
				$view_file = 'accounts-editor' ;
				$model = Account::find($user_id) ;
				if(!$model)
					return view('errors.m410');
				$model->spreadMeta() ;
				break ;

			case 'undelete' :
			case 'hard_delete' :
				$permit .= '.bin' ;
				break;

			default:
				dd("$view_file: $user_id");
		}

		if(!Auth::user()->can($permit))
			return view('errors.m403');

		//View...
		$view = "manage.customers.$view_file" ;
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
				'success_refresh' => true ,
		]);

	}

	public function soft_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('customers.delete'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$model = User::find($request->id) ;
		if(!$model)
			return $this->jsonFeedback(trans('validation.http.Error410'));

		if($model->isAdmin())
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = $model->delete();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('customers.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = User::onlyTrashed()->where('id', $request->id)->restore();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);


	}

	public function hard_delete(Request $request)
	{
		//Security...
		if(!Auth::user()->can('customers.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$model = User::findCustomer($request->id , true) ;
		if(!$model)
			return $this->jsonFeedback(trans('validation.http.Error410'));

		$done = $model->fakeDestroy() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function account(Requests\Manage\AccountSaveRequest $request)
	{
		$user = User::findCustomer($request->user_id) ;
		if(!$user)
			return $this->jsonFeedback(trans('validation.http.Error403'));

		if($request->_submit == 'save')
			$ok = Account::store($request) ;
		else
			$ok = Account::destroy($request->id) ;

		return $this->jsonAjaxSaveFeedback($ok , [
				'success_refresh' => true
		]);
	}


}

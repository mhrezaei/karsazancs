<?php

namespace App\Http\Controllers\Manage;

use App\Models\Account;
use App\models\Branch;
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


class CustomersController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['customers' , trans('manage.modules.customers')];
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


	public function browse($request_tab = 'ordinaries')
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["browse/".$request_tab , trans("people.status.$request_tab") , $request_tab] ;

		//Permissions...
		switch($request_tab) {
			case 'bin' :
				$permit = 'bin';
				break;
			case 'newsletter_member' :
				$permit = 'send';
				break;
			default:
				$permit = '*' ;
		}
		if(!Auth::user()->can("customers.$permit"))
			return view('errors.403');

		//Model...
		$model_data = User::selector('customers',$request_tab)->orderBy('created_at' , 'desc')->paginate(50);
		$db = new User() ;

		//View...
		return view("manage.customers.browse" , compact('page','model_data' , 'db'));

	}
	public function update($model_id)
	{
		$model = User::withTrashed()->find($model_id);
		$selector = true ;
		if(!$model)
			return view('errors.m410');
		else
			return view('manage.customers.browse-row' , compact('model' , 'selector'));
	}

	public function updateAccount($model_id)
	{
		$model = Account::find($model_id);
		$counter = true ;
		if(!$model)
			return view('errors.m410');
		else
			return view('manage.customers.accounts-row' , compact('model' , 'counter'));
	}

	public function modalActions($user_id , $view_file)
	{
		if($user_id===0)
			return $this->modalBulkAction($view_file);

		$opt = [] ;

		//Model...
		if(str_contains($user_id , 'n')) {
			$user_id = intval($user_id) ;
		}
		elseif($user_id == 'site') {
			;
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
				if(isset($model)) {
					$user = $model;
					$model = new Account() ;
					$model->user_id = $user->id ;
					$model->user_name = $user->full_name ;
				}
				else {
					$model = new Account() ;
					$model->user_id = 0 ;
				}
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

	private function modalBulkAction($view_file)
	{
		//Bypass...
		if(in_array($view_file , ['individual' , 'legal']))
			$this->create($view_file);

		//Main...
		$view = "manage.admins.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view) ;
	}

	public function editor($model_id=0)
	{
		//Model...
		$states = State::get_combo() ;

		if($model_id) {
			$permit = 'customers.edit' ;
			$model = User::find($model_id);
			if(!$model or $model->isAdmin())
				return view('errors.m410');
			$model->spreadMeta();
		}
		else {
			$permit = 'customers.create' ;
			$model = new User();
			$model->customer_type = 1 ;
		}

		//Permission...
		if(!Auth::user()->can($permit))
			return view('errors.403');

		//View...
		return view( 'manage.customers.editor', compact('model' , 'states'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\CustomerSaveRequest $request)
	{
		//Preparations...
		$data = $request->toArray() ;
		if($request->id) {
			$user = User::find($request->id)  ;
			if(!$user or $user->isAdmin() or $user->isDeveloper())
				return $this->jsonFeedback(trans('validation.http.Error403'));
		}
		else {
			if(Auth::user()->can('customers.activation')) {
				$data['status'] = 8;
				$data['published_by'] = Auth::user()->id ;
				$data['published_at'] = Carbon::now()->toDateTimeString() ;
			}
			else
				$data['status'] = 4 ;
			$data['password'] = Hash::make($request->mobile) ;
			$data['password_force_change'] = 1 ;
		}

		//Save and Return...
		$saved = User::store($data , ['customer_type']);

		return $this->jsonAjaxSaveFeedback($saved , [
			'success_callback' => "rowUpdate('tblCustomers','$request->id')",
		]);

	}

	public function change_password(Requests\Manage\CustomerChangePasswordRequest $request)
	{
		//Preparations...
		$model = User::findCustomer($request->id) ;

		//Save...
		$model->password = Hash::make($request->password) ;
		$model->password_force_change = 1 ;
		$is_saved = $model->save();

		if($is_saved and $request->sms_notify)
			;//@TODO: Call the event
		//Event::fire(new VolunteerPasswordManualReset($model , $request->password));

		return $this->jsonAjaxSaveFeedback($is_saved);
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
				'success_callback' => "rowHide('tblCustomers','$request->id')",
		]);

	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('customers.bin'))
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = User::onlyTrashed()->where('id', $request->id)->restore();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblCustomers','$request->id')",
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
				'success_callback' => "rowHide('tblCustomers','$request->id')",
		]);

	}

	public function account(Requests\Manage\AccountSaveRequest $request)
	{
		if($request->user_id>0) {
			$user = User::findCustomer($request->user_id) ;
			if(!$user)
				return $this->jsonFeedback(trans('validation.http.Error403'));
		}

		if($request->_submit == 'save') {
			$ok = Account::store($request) ;
			$callback = "rowUpdate('tblAccounts','$request->id')" ;
		}
		else {
			$ok = Account::destroy($request->id);
			$callback = "rowHide('tblAccounts','$request->id')" ;
		}

		return $this->jsonAjaxSaveFeedback($ok , [
				'success_callback' => $callback,
		]);
	}


}

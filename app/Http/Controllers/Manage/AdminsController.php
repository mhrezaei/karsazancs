<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Department;
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


class AdminsController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['admins' , trans('manage.admins')];
	}

	public function search(Requests\Manage\AdminSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("forms.button.search") , "search"] ;
		$db = new User();

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = User::selector('admins' ,"search_admin:$keyword")->orderBy('created_at' , 'desc')->paginate(50);
			return view('manage.admins.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.admins.search" , compact('page' , 'db'));

	}


	public function browse($request_tab = 'ordinaries')
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["browse/".$request_tab , trans("people.admins.$request_tab") , $request_tab] ;

		//Model...
		$model_data = User::selector('admins',$request_tab)->orderBy('created_at' , 'desc')->paginate(50);
		$db = new User() ;

		//View...
		return view("manage.admins.browse" , compact('page','model_data' , 'db'));

	}

	public function update($model_id)
	{
		$model = User::withTrashed()->find($model_id);
		$selector = true ;
		if(!$model)
			return view('errors.m410');
		else
			return view('manage.admins.browse-row' , compact('model' , 'selector'));
	}


	public function modalActions($user_id , $view_file)
	{

		if($user_id==0)
			return $this->modalBulkAction($view_file);

		$model = User::find($user_id) ;
		$view = "manage.admins.$view_file" ;
		$opt = [] ;

		//Particular Actions...
		switch($view_file) {
			case 'permits' :
				if(!$model->canBePermitted())
					return view('errors.m403');

				$opt['branches'] = Branch::orderBy('plural_title')->get() ;
				$opt['modules'] = User::availableModules() ;
				$opt['departments'] = Department::orderBy('title')->get() ;
				break;

			case 'undelete' :
			case 'hard_delete' :
				$model = User::where('id' , $user_id)->withTrashed()->first();
				break;
		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt' , 'states')) ;
	}

	private function modalBulkAction($view_file)
	{
		$view = "manage.admins.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view) ;
	}


	public function editor($model_id=0)
	{
		//Model...
		if($model_id) {
			$model = User::find($model_id);
			if(!$model or !$model->isAdmin())
				return view('errors.m410');
		}
		else {
			$model = new User();
		}

		//View...
		return view( 'manage.admins.editor', compact('model'));

	}

	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function save(Requests\Manage\AdminSaveRequest $request)
	{
		//Preparations...
		$data = $request->toArray() ;
		if($request->id) {
			$user = User::find($request->id)  ;
			if(!$user or !$user->isAdmin())
				return $this->jsonFeedback(trans('validation.http.Error403'));
			if($user->isDeveloper() and !Auth::user()->isDeveloper())
				return $this->jsonFeedback(trans('validation.http.Error403'));
		}
		else {
			$data['status'] = 91 ;
			$data['password'] = Hash::make($request->mobile) ;
			$data['password_force_change'] = 1 ;
		}

		//Save and Return...
		$saved = User::store($data);

		return $this->jsonAjaxSaveFeedback($saved , [
				'success_callback' => "rowUpdate('tblAdmins','$request->id')",
		]);

	}

	public function change_password(Requests\Manage\AdminChangePasswordRequest $request)
	{
		//Preparations...
		$model = $user = User::find($request->id) ;
		if(!$user or !$user->isAdmin())
			return $this->jsonFeedback(trans('validation.http.Error403'));
		if($user->isDeveloper() and !Auth::user()->isDeveloper())
			return $this->jsonFeedback(trans('validation.http.Error403'));

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
		$model = User::find($request->id) ;
		if(!$model)
			return $this->jsonFeedback(trans('validation.http.Error410'));

		if($model->id == Auth::user()->id)
			return $this->jsonFeedback();

		if($model->isDeveloper())
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = $model->delete();

		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblAdmins','$request->id')",
		]);

	}

	public function undelete(Request $request)
	{
		$done = User::withTrashed()->where('id', $request->id)->restore();
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblAdmins','$request->id')",
		]);


	}

	public function hard_delete(Request $request)
	{
		//Security...
		$model = User::withTrashed()->where('id' , $request->id )->first() ;
		if(!$model)
			return $this->jsonFeedback(trans('validation.http.Error410'));

		if($model->id == Auth::user()->id)
			return $this->jsonFeedback();

		if($model->isDeveloper())
			return $this->jsonFeedback(trans('validation.http.Error403'));

		$done = $model->forceDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblAdmins','$request->id')",
		]);

	}


	public function permits(Request $request)
	{
		//Preparations...
		$model = User::find($request->id) ;
		$logged_user = Auth::user() ;
		$allowed_roles = [] ;

		//Security...
		if(!$model)
			return $this->jsonFeedback(trans('validation.http.Error410')) ;

		if(!$model->canBePermitted())
			return $this->jsonFeedback(trans('validation.http.Error403')) ;

		//is level changed?
		$level_changed = $model->admin_role != $request->level ;


		//Roles...
		if($logged_user->isSuperAdmin() and $request->level == 'super') {
			array_push($allowed_roles , 'admins');
			array_push($allowed_roles , 'settings');
			$super_admin = true ;
		}
		else {
			$super_admin = false ;
		}
		foreach($request->toArray() as $field => $value) {
			if(!str_contains($field , 'role_') or !$value)
				continue ;

			$role = str_replace('role_' , null , $field) ;
			$role = str_replace('_' , '.' , $role) ;
			if($logged_user->can($role))
				array_push($allowed_roles , $role) ;
		}

		//Save...
		$ok = $model->setPermits($allowed_roles , $super_admin) ;

		//Return...
		return $this->jsonAjaxSaveFeedback($ok , [
			'success_refresh' => $level_changed? true : false
		]) ;
	}


}

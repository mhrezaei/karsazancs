<?php

namespace App\Http\Controllers\Manage;

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


class AdminsController extends Controller
{
	use TahaControllerTrait;

	public function __construct()
	{
		$this->page[0] = ['admins' , trans('manage.admins')];
	}

	public function search(VolunteerSearchRequest $request)
	{
		//Preparation...
		$page = $this->page ;
		$page[1] = ["search" , trans("people.volunteers.manage.search") , "search"] ;
		$db = User::first() ;

		//IF SEARCHED...
		$keyword = $request->keyword ;
		if(isset($request->searched)) {
			$model_data = User::selector('volunteers' , "search:$keyword")->orderBy('volunteer_registered_at' , 'desc')->paginate(50);
			return view('manage.volunteers.browse' , compact('page' , 'model_data' , 'db' , 'keyword'));
		}

		//IF JUST FORM...
		return view("manage.volunteers.search" , compact('page' , 'db'));

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
				break;
		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt' , 'states')) ;
	}

	private function modalBulkAction($view_file)
	{
		$view = "manage.volunteers.$view_file-bulk" ;

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

	public function inquiry(Requests\Manage\CardInquiryRequest $request)
	{
		$user = User::findBySlug($request->code_melli , 'code_melli') ;

		if(!$user){
			return $this->jsonFeedback([
					'ok' => 1 ,
					'message' => trans('people.cards.manage.inquiry_success') ,
					'callback' => 'cardEditor(1)' ,
//					'redirectTime' => 1 ,
			]);
		}

		if($user->volunteer_status < 0) {
			return $this->jsonFeedback([
				'ok' => 0 ,
				'message' => trans('people.cards.manage.inquiry_was_volunteer') ,
			]);
		}

		if($user->volunteer_status > 0) {
			return $this->jsonFeedback(1,[
					'ok' => 1 ,
					'message' => trans('people.cards.manage.inquiry_is_volunteer') ,
					'redirect' => Auth::user()->can('volunteers.edit')? url("manage/volunteers/$user->id/edit") : '' ,
					'redirectTime' => 1 ,
			]);
		}

		if($user->isCard()) {
			return $this->jsonFeedback([
					'ok' => 1 ,
					'message' => trans('people.cards.manage.inquiry_has_card') ,
					'redirect' => url("manage/volunteers/$user->id/edit") ,
//					'redirectTime' => 1 ,
			]);
		}

		return $this->jsonFeedback([
				'ok' => 0 ,
				'message' => "it's complicated!" ,
//				'redirect' => url("manage/volunteers/$user->id/edit") ,
//				'redirectTime' => 1 ,
		]);


	}


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
			'success_refresh' => true ,
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
	
	public function publish(Request $request)
	{
		if(!Auth::user()->can('volunteers.publish')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		if($model->volunteer_status<0)
			return $this->jsonFeedback() ;

		$model->published_at = Carbon::now()->toDateTimeString() ;
		$model->published_by = Auth::user()->id ;
		$model->volunteer_status = 8 ;
		$is_saved = $model->save();

		if($is_saved)
			;//@TODO: Call the event
//			Event::fire(new VolunteerAccountPublished($model));

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_publish(Request $request)
	{
		if(!Auth::user()->can('volunteers.publish')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Action...
		$ids = $request->ids ;
		if(!is_array($ids))
			$ids = explode(',',$ids);

		$done = User::whereIn('id',$ids)->where('volunteer_status' , '>' , '0')->where('volunteer_status' , '<' , '8')->update([
				'published_at' => Carbon::now()->toDateTimeString() ,
				'published_by' => Auth::user()->id ,
				'volunteer_status' => 8 ,
		]);

		//Feedback...
		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

		//@TODO: Event
	}

	public function soft_delete(Request $request)
	{
		if(!Auth::user()->can('volunteers.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;
		if($request->id == Auth::user()->id) return $this->jsonFeedback();

		$model = User::find($request->id) ;
		$done = $model->volunteerDelete();

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);

	}

	public function bulk_soft_delete(Request $request)
	{
		if(!Auth::user()->can('volunteers.delete')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$ids = explode(',',$request->ids);
		foreach($ids as $id) {
			$model = User::find($id) ;
			if($model and $id != Auth::user()->id)
				$done = $model->volunteerDelete() ;
		}

		return $this->jsonAjaxSaveFeedback($done , [
			'success_refresh' => true ,
		]);
	}

	public function undelete(Request $request)
	{
		if(!Auth::user()->can('volunteers.bin')) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		$done = $model->volunteerUndelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function bulk_undelete(Request $request)
	{
		if(!Auth::user()->can('volunteers.bin'))
			return $this->jsonFeedback(trans('validation.http.Eror403'));

		$ids = explode(',', $request->ids);
		foreach($ids as $id) {
			$model = User::find($id);
			if($model and $id != Auth::user()->id)
				$done = $model->volunteerUndelete();
		}

		return $this->jsonAjaxSaveFeedback($done, ['success_refresh' => true,]);
	}

	public function hard_delete(Request $request)
	{
		if(!Auth::user()->isDeveloper()) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$model = User::find($request->id) ;
		if(!$model or $model->volunteer_status>0)
			return $this->jsonFeedback(trans('validation.http.Eror403'));

		$done = $model->volunteerHardDelete() ;

		return $this->jsonAjaxSaveFeedback($done , [
				'success_refresh' => true ,
		]);

	}

	public function bulk_hard_delete(Request $request)
	{
		if(!Auth::user()->isDeveloper()) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		$ids = explode(',', $request->ids);
		foreach($ids as $id) {
			$model = User::find($id);
			if($model and $model->volunteer_status<0 and $id != Auth::user()->id)
				$done = $model->volunteerHardDelete();
		}

		return $this->jsonAjaxSaveFeedback($done, [
				'success_refresh' => true,
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

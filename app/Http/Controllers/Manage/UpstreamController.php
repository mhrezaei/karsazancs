<?php

namespace App\Http\Controllers\Manage;

use App\Models\Activity;
use App\models\Branch;
use App\Models\Category;
use App\Models\Department;
use App\Models\Domain;
use App\Models\Post_cat;
use App\Models\Setting;
use App\Models\State;
use App\Models\User;
use App\Traits\TahaControllerTrait;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class UpstreamController extends Controller
{
	use TahaControllerTrait ;
	private $page = array();

	public function __construct()
	{
		$this->page[0] = ['upstream' , trans('manage.settings.upstream') , ];
	}

	public function index($request_tab = 'downstream')
	{
		//Preparetions...
		$page = $this->page;
		$page[1] = [$request_tab , trans("manage.settings.$request_tab")];

		//Model...
		switch($request_tab) {
			case 'states' :
				$model_data = State::get_provinces()->orderBy('title')->get();
				break;

			case 'branches' :
				$model_data = Branch::orderBy('plural_title')->get();
				break ;

			case 'departments' :
				$model_data = Department::orderBy('title')->get() ;
				break;

			case 'downstream' :
				$model_data = Setting::orderBy('category')->orderBy('title')->paginate(100) ;
				break;

			case 'categories' :
				$model_data = State::get_provinces()->orderBy('title')->get();
				break;


			default :
				return view('errors.404');
		}

		//View...
		return view("manage.settings.$request_tab", compact('page', 'model_data'));

	}



	public function editor($request_tab , $item_id=0 , $parent_id=0)
	{
		//Appears in modal and doesn't need $this->page stuff

		switch($request_tab) {
			case 'city' :
				if($item_id) {
					$model = State::find($item_id) ;
					if(!$model or $model->isProvince()) {
						return view('errors.m410');
					}
					$provinces = State::get_provinces()->orderBy('title')->get() ;
				}
				else {
					if(!$parent_id) {
						return view('errors.m404');
					}
					$provinces = State::get_provinces()->orderBy('title')->get() ;
					$model = new State() ;
					$model->parent_id = $parent_id ;
				}
				return view('manage.settings.states-cities-edit', compact('model' , 'provinces'));

			case 'state' :
				if($item_id) {
					$model = State::find($item_id) ;
					if(!$model or !$model->isProvince())
						return view('errors.m410');
				}
				else
					$model = new State() ;
				return view('manage.settings.states-edit', compact('model'));

			case 'downstream' :
				if($item_id>0) {
					$model = Setting::find($item_id);
					if(!$model)
						return trans('validation.invalid');
				}
				else {
					$model = new Setting() ;
				}
				return view('manage.settings.downstream-edit' , compact('model'));

			case 'department' :
				if($item_id) {
					$model = Department::find($item_id) ;
					if(!$model)
						return view('errors.m410');
				}
				else {
					$model = new Department() ;
				}
				return view('manage.settings.departments-edit' , compact('model'));
				break;


			case 'branch' :
				if($item_id) {
					$model = Branch::find($item_id);
					if(!$model)
						return view('errors.m410');
				}
				else {
					$model = new Branch();
				}
				return view('manage.settings.branches-edit', compact('model'));

			case 'categories' :
				if($item_id) {
					$model = Category::find($item_id);
					if(!$model)
						return view('errors.m410');
				}
				else {
					$model = new Category() ;
					$model->branch_id = $parent_id ;
				}
				$branches = Branch::selector('category') ;
				return view('manage.settings.categories_edit' , compact('model' , 'branches'));

			default:
				return view('errors.m404');
		}

	}

	public function item($request_tab, $item_id)
	{

		//Preparation...
		$page = $this->page;
		$page[1] = [$request_tab , trans("manage.settings.$request_tab")];
		$page[2] = ['edit',null,''];
		$view = "manage.settings." ;
		
		switch($request_tab) {
			case 'states':
				$province = State::find($item_id) ;
				if(!$province or !$province->isProvince())
					return view('errors.410');
				$model_data = State::get_cities($item_id)->orderBy('title')->get();
				$page[2][1] = trans('manage.settings.cities_of' , ['province'=>$province->title]) ;
				return view('manage.settings.states-cities', compact('page', 'model_data' , 'province'));
				break;

			case 'downstream' :
				$model = Setting::find($item_id) ;
				if(!$model)
					return view('errors.m410');

				return view('manage.settings.downstream-value' , compact('model'));
				break;

			case 'branches' :
				$branch = Branch::find($item_id) ;
				if(!$branch)
					return view('errors.410');
				$model_data = $branch->categories()->get() ;
				$page[1] = [$request_tab , trans("manage.settings.categories")];
				$page[2] = ['categories' , $branch->title() , $item_id];
				return view('manage.settings.categories', compact('page', 'model_data','branch'));
				break;

			default:
				return view('templates.say' , ['array'=>"What the hell is $request_tab?"]); //@TODO: REMOVE THIS

		}


		if(!View::exists($view))
			return view('templates.say' , ['array'=>"View '$view' is not found."]); //@TODO: REMOVE THIS



		if(!isset($model_data) or !$model_data or !View::exists($view))
			return view('errors.m404');

		//View...
		return view($view, compact('page', 'model_data'));

	}

	public function search($request_tab , $key)
	{
		//Preparation...
		$page = $this->page;
		$page[1] = [$request_tab , trans("manage.settings.$request_tab")];
		$view = "manage.settings." ;

		switch($request_tab) {
			case 'downstream' :
				$model_data = Setting::where('title' , 'like' , "%$key%")->orWhere('slug' , 'like' , "%$key%")->orderBy('title')->paginate(100);
				$view .= 'downstream' ;
				$page[2] = ['search',trans('forms.button.search_for')." $key",''];
				break;

			case 'states' :
				$model_data = State::where([
					['title' , 'like' , '%'.$key.'%'] ,
					['parent_id' , '<>' , '0']
				])->orderBy('title')->get();
				$view .= "states-cities";
				$page[2] = ['search',trans('forms.button.search_for')." $key",''];
				break;

			default:
				return view('templates.say' , ['array'=>"What the hell is $request_tab?"]); //@TODO: REMOVE THIS
				return view('errors.404');
		}

		//View...
		return view($view, compact('page', 'model_data' , 'key'));

	}


	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function saveDepartment(Requests\Manage\DepartmentSaveRequest $request)
	{
		//If Save...
		if($request->_submit == 'save') {
			return $this->jsonAjaxSaveFeedback(Department::store($request) ,[
					'success_refresh' => 1,
			]);
		}

		//If Delete...
		if($request->_submit == 'delete') {
			$model = Department::find($request->id) ;
			if(!$model)
				return $this->jsonFeedback();

			return $this->jsonAjaxSaveFeedback($model->delete() ,[
					'success_refresh' => 1,
			]);
		}

	}

	public function saveBranch(Requests\Manage\BranchSaveRequest $request)
	{
		//If Save...
		if($request->_submit == 'save') {
			return $this->jsonAjaxSaveFeedback(Branch::store($request) ,[
					'success_refresh' => 1,
			]);
		}

		//If Delete...
		if($request->_submit == 'delete') {
			$model = Branch::find($request->id) ;
			if(!$model)
				return $this->jsonFeedback();

			return $this->jsonAjaxSaveFeedback(Branch::destroy($request->id) ,[
					'success_refresh' => 1,
			]);
		}

	}



	public function saveProvince(Requests\Manage\ProvinceSaveRequest $request)
	{
		//If Save...
		if($request->_submit == 'save') {
			return $this->jsonAjaxSaveFeedback(State::store($request) ,[
				'success_refresh' => 1,
			]);
		}

		//If Delete...
		if($request->_submit == 'delete') {
			$model = State::find($request->id) ;
			if(!$model or !$model->isProvince() or $model->cities()->count())
				return $this->jsonFeedback();

			return $this->jsonAjaxSaveFeedback(State::destroy($request->id) ,[
					'success_refresh' => 1,
			]);
		}


	}

	public function saveCity(Requests\Manage\CitySaveRequest $request)
	{
		$data = $request->toArray() ;

		//If Save...
		if($data['_submit'] == 'save') {
			$data['parent_id'] = $data['province_id'] ;
			unset($data['province_id']);

			return $this->jsonAjaxSaveFeedback(State::store($data) ,[
					'success_refresh' => 1,
			]);
		}

		//If Delete...
		if($data['_submit'] == 'delete') {
			return $this->jsonAjaxSaveFeedback(State::destroy($data['id']) ,[
					'success_refresh' => 1,
			]);
		}

	}

	public function saveCategory(Requests\Manage\CategorySaveRequest $request)
	{
		//If Save...
		if($request->_submit == 'save') {
			return $this->jsonAjaxSaveFeedback(Category::store($request) ,[
					'success_refresh' => 1,
			]);
		}

		//If Delete...
		if($request->_submit == 'delete') {
			$model = Category::find($request->id) ;
			if(!$model)
				return $this->jsonFeedback();

			$model->posts()->update(['category_id' => '0']);
			return $this->jsonAjaxSaveFeedback($model->forceDelete() , [
					'success_refresh' => 1,
			]);

		}
	}

	public function saveDownstream(Requests\Manage\DownstreamSaveRequest $request)
	{
		if($request->_submit == 'save') {
			return $this->jsonAjaxSaveFeedback(Setting::store($request) ,[
					'success_refresh' => 1,
			]);
		}
		else {
			return $this->jsonAjaxSaveFeedback(Setting::destroy($request->id) , [
					'success_refresh' => 1,
			]);
		}
	}

	public function setDownstream(Request $request)
	{
		//Preparations...
		$data = $request->toArray();
		$model = Setting::find($request->id);
		if(!$model)
			return $this->jsonFeedback(trans('validation.http.Eror410'));

		//Purification of the global value...
		switch ($request->data_type) {
			case 'bool' :
				$data['default_value'] += 0 ;
				$data['custom_value'] += 0 ;
				break;

			case 'date' :
				$carbon1 = new Carbon($data['default_value']);
				$carbon2 = new Carbon($data['custom_value']);
				$data['default_value'] = $carbon1->toDateString();
				$data['custom_value'] = $carbon2->toDateString();
				break;

			case 'photo' :
				$data['default_value'] = str_replace(url('') , null , $data['default_value']);
				$data['custom_value'] = str_replace(url('') , null , $data['custom_value']);
				break ;

		}

		//Save...
		$model->default_value = $data['default_value'] ;
		$model->custom_value = $data['custom_value'] ;

		return $this->jsonAjaxSaveFeedback($model->update() , [
				'success_refresh' => 1,
		]);

	}


	public function loginAs(Request $request)
	{
		$user = User::find($request->id) ;
		if(!$user->isAdmin())
			return $this->jsonFeedback('user is not as admin');


		$request->session()->set('logged_developer' , encrypt(Auth::user()->id)) ;
		$ok = Auth::loginUsingId( $user->id );
		return $this->jsonAjaxSaveFeedback($ok , [
				'success_redirect' => url('/manage'),
		]);

	}

}

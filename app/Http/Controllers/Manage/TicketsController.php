<?php

namespace App\Http\Controllers\Manage;

use App\models\department;
use App\Models\Category;
use App\Models\Post;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;

class TicketsController extends Controller
{
    	use TahaControllerTrait;

	private $page = [];

	public function __construct()
	{
	}

	public function searchPanel($request_department)
	{
		//Security...
		if(!Auth::user()->can("posts-$request_department.browse"))
			return view('errors.403');

		//Model...
		$db = Post::first() ;
		$department = department::selectBySlug($request_department);

		//Page Construction...
		$page = $this->page ;
		$page[0] = ["posts/".$request_department , $department->title() , 'search'] ;
		$page[1] = ["$request_department/search" , trans("forms.button.search") , "$request_department/search"] ;

		//View...
		return view("manage.posts.search" , compact('page' , 'db' , 'department'));

	}

	public function searchResult(Requests\Manage\PostSearchRequest $request , $request_department)
	{
		//Security...
		if(!Auth::user()->can("posts-$request_department.browse"))
			return view('errors.403');

		//Model...
		$db = Post::first() ;
		$department = department::selectBySlug($request_department);
		$keyword = $request->keyword ;
		$model_data = Post::selector($request_department , 'all')
				->whereRaw(Post::searchRawQuery($keyword))
				->paginate(50);

		//Page Construction...
		$page = $this->page ;
		$page[0] = ["posts/".$request_department , $department->title() , 'search'] ;
		$page[1] = ["$request_department/search" , trans("forms.button.search") , "$request_department/search"] ;

		//View...
		return view("manage.posts.browse" , compact('page','department','model_data' , 'db' , 'keyword'));

	}

	public function browse($request_department, $request_tab = 'open')
	{
		//Redirect if $request_department is a number!
		if(is_numeric($request_department))
			return $this->modalActions($request_department , $request_tab) ;

		//Redirect if create
//		if($request_tab=='create')
//			return $this->create($request_department);

		//Permission...
		switch($request_tab) {
			case 'bin' :
				$permission = "$request_department.bin" ;
				break;

			default:
				$permission = "$request_department.browse" ;
		}
		if(!Auth::user()->can('tickets-'.$permission))
			return view('errors.403');

		//Preparation...
		$department = department::selectBySlug($request_department);
		if(!$department)
			return view('errors.404');

		$page = $this->page ;
		$page[0] = ["tickets/".$request_department , trans('manage.modules.tickets') , $request_tab] ;
		$page[1] = ["tickets/".$request_department , $department->title , 'open'] ;
		$page[2] = ["$request_department/".$request_tab , trans("tickets.status.$request_tab") , $request_tab] ;

		//Model...
		$model_data = Ticket::selector($request_department, $request_tab)->orderBy('updated_at' , 'desc')->orderBy('created_at' , 'desc')->paginate(50);
		$db = new Ticket();

		//View...
		return view("manage.tickets.browse" , compact('page','department','model_data' , 'db'));

	}

	public function update($model_id)
	{
		$model = Ticket::withTrashed()->find($model_id);
		$selector = true ;
		if(!$model)
			return view('errors.m410');
		else
			return view('manage.tickets.browse-row' , compact('model' , 'selector'));
	}

	public function modalActions($post_id, $view_file)
	{
		if($post_id==0)
			return $this->modalBulkAction($view_file);

		$model = Post::withTrashed()->find($post_id);
		$view = "manage.posts.$view_file";
		$opt = [] ;

		//Particular Actions..
		switch($view_file) {
			case 'permits' :
				break;
			case 'delete' :
				return $this->soft_delete($post_id);
			case 'undelete' :
				return $this->undelete($post_id) ;
			case 'unpublish' :
				return $this->unpublish($post_id) ;
		}

		if(!$model) return view('errors.m410');
		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view , compact('model' , 'opt')) ;

	}



	private function modalBulkAction($view_file)
	{
		$view = "manage.posts.$view_file-bulk" ;

		if(!View::exists($view)) return view('templates.say' , ['array'=>$view]); //@TODO: REMOVE THIS LINE
		if(!View::exists($view)) return view('errors.m404');

		return view($view) ;
	}

	public function create($department_slug , $user_id = 0)
	{
		//Model...
		$model = new Ticket() ;
		$model->priority = 2 ;
		$model->user_id = 0 ;

		if($user_id) {
			$user = User::findCustomer($user_id);
			if($user)
				$model->user_id = $user_id;
			else
				return $this->jsonFeedback(trans('validation.http.Error410'));
		}

		if($department_slug) {
			$model->department = $department_slug;
			if(!$model->department())
				$model->department = null;
		}
		else
			$model->department = null ;

		//Permission...
		if(!Auth::user()->can("tickets-$department_slug.create"))
			return view('errors.403');

		//View...
		return view('manage.tickets.editor' , compact('model'));

	}

	public function editor($ticket_id)
	{
		//Model...
		$model = Ticket::withTrashed()->find($ticket_id) ;
		if(!$model)
			return view('errors.410');

		//Permission...
		if(!Auth::user()->can("tickets-$model->department.edit"))
			return view('errors.m403');

		//View...
		return view('manage.tickets.editor' , compact('model'));

	}
	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	private function unpublish($post_id)
	{
		//Preparations...
		$model = Post::find($post_id) ;
		if(!$model) return $this->jsonFeedback() ;

		if(!Auth::user()->can('posts-'.$model->department.".publish"))
			return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		//Action...
		if($model->unpublish())
			echo ' <div class="alert alert-success">'. trans('forms.feed.done') .'</div> ';
		else
			echo ' <div class="alert alert-danger">'. trans('forms.feed.error') .'</div> ';

	}


	/**
	 * @param $post_id
	 */
	public function soft_delete($post_id)
	{

		//Preparations...
		$model = Post::find($post_id) ;
		if(!$model)
			$this->feedback() ;

		if(!$model->canDelete())
			$this->feedback(false , trans('validation.http.Eror403'));

		//Action...
		$is_ok = $model->delete() ;
		$this->feedback($is_ok);


	}


	public function hard_delete(Request $request)
	{
		$model = Post::withTrashed()->find($request->id) ;
		if(!Auth::user()->isDeveloper() ) return $this->jsonFeedback(trans('validation.http.Eror403')) ;

		if(!$model->trashed()) return $this->jsonFeedback(trans('validation.http.Eror403'));


		$done = $model->forceDelete();

		return $this->jsonAjaxSaveFeedback($done , [
//				'success_refresh' => true ,
		]);

	}

	/**
	 * @param Requests\PostSaveRequest $request
	 * @return string
	 */
	public function save(Requests\Manage\TicketSaveRequest $request)
	{
		$data = $request->toArray() ;
		//Validation...
		if($request->user_id)
			$user = User::findCustomer($request->user_id) ;
		else
			$user = User::where('code_melli' , $request->code_melli)->where('status' , '<' , '90')->first() ; 
		if(!$user)
			return $this->jsonFeedback(trans('forms.feed.user_not_found'));
		$data['user_id'] = $user->id ;

		//Save...
		$is_saved = Ticket::store($data , ['code_melli']) ;

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_callback' => "rowUpdate('tblTickets','$request->id')",
		]);


	}

	public function undelete($post_id)
	{
		$model = Post::withTrashed()->find($post_id) ;
		if(!$model) return $this->jsonFeedback() ;

		if(!$model->canDelete())
			$this->feedback(false , trans('validation.http.Eror403'));

		//Action...
		$ok = $model->restore() ;
		$this->feedback($ok);

	}



}



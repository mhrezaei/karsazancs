<?php

namespace App\Http\Controllers\Manage;

use App\models\department;
use App\Models\Category;
use App\Models\Post;
use App\Models\Talk;
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

	public function modalActions($item_id , $view_file='editor')
	{
		//Bypass...
		if($item_id==0)
			return $this->modalBulkAction($view_file);

		$opt = [] ;

		//Model...
		if(str_contains($item_id , 'n')) {
			$item_id = intval($item_id) ;
		}
		else {
			$model = Ticket::withTrashed()->find($item_id);
			if(!$model)
				return view('errors.m410');
		}

		//Permission...
		$permit = "tickets-".$model->department ;

		switch($view_file) {
			case 'editor' :
				$permit .= '.edit' ;
				break;

			case 'reply':
				break;

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
		$view = "manage.tickets.$view_file" ;
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


	/*
	|--------------------------------------------------------------------------
	| Save Methods
	|--------------------------------------------------------------------------
	|
	*/

	public function soft_delete(Request $request)
	{

		//Preparations...
		$model = Ticket::find($request->id) ;
		if(!$model)
			$this->feedback() ;

		if(!$model->canDelete())
			$this->feedback(false , trans('validation.http.Error403'));

		//Action...
		$is_ok = $model->delete() ;

		//Feedback...
		return $this->jsonAjaxSaveFeedback($is_ok , [
				'success_callback' => "rowHide('tblTickets','$request->id')",
		]);
	}

	public function undelete(Request $request)
	{
		//Preparations...
		$model = Ticket::onlyTrashed()->find($request->id) ;
		if(!$model)
			$this->feedback() ;

		if(!$model->canBin())
			$this->feedback(false , trans('validation.http.Error403'));

		//Action...
		$is_ok = $model->restore() ;

		//Feedback...
		return $this->jsonAjaxSaveFeedback($is_ok , [
				'success_callback' => "rowHide('tblTickets','$request->id')",
		]);
	}


	public function hard_delete(Request $request)
	{
		//Preparations...
		$model = Ticket::onlyTrashed()->find($request->id) ;
		if(!$model)
			$this->feedback() ;

		if(!$model->canBin())
			$this->feedback(false , trans('validation.http.Error403'));

		//Action...
		$done = $model->forceDelete();

		//Feedback...
		return $this->jsonAjaxSaveFeedback($done , [
				'success_callback' => "rowHide('tblTickets','$request->id')",
		]);

	}

	public function saveReply(Requests\Manage\TicketReplyRequest $request)
	{
		//Model...
		$ticket = Ticket::find($request->id) ;
		if(!$ticket)
			return $this->jsonFeedback(trans('validation.http.Error410'));

		//Save...
		$ticket->update([
			'department' => $request->department ,
			'title' => $request->title ,
			'priority' => $request->priority ,
		]);

		if($request->text) {
			$is_saved = Talk::store([
				'ticket_id' => $ticket->id ,
				'text' => $request->text ,
				'created_by' => Auth::user()->id ,
				'is_admin' => 1 ,
			]) ;
		}

		//Feedback...
		return $this->jsonAjaxSaveFeedback($is_saved , [
				'success_callback' => "rowUpdate('tblTickets','$request->id')",
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

		//Close and reopen...
		if($request->_submit == 'archive') {
			$data['archived_at'] = Carbon::now()->toDateTimeString() ;
			$data['archived_by'] = Auth::user()->id ;
			$page_refresh = true ;
		}
		elseif($request->_submit == 'reopen') {
			$data['archived_at'] = null ;
			$data['archived_by'] = null ;
			$page_refresh = true ;
		}
		else
			$page_refresh = false ;

		//Save...
		$is_saved = Ticket::store($data , ['code_melli' , 'text']) ;
		if($is_saved) {
			$talk = Talk::firstOrNew(['ticket_id' => $is_saved]);
			$talk->text = $request->text ;
			$talk->created_by = $user->id ;
			$talk->updated_by = Auth::user()->id ;
			$talk->save();
		}

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_callback' => "rowUpdate('tblTickets','$request->id')",
			'success_refresh' => $page_refresh? 1 : 0 ,
		]);


	}



}



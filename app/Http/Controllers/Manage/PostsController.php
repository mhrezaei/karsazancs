<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Category;
use App\Models\Post;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;

class PostsController extends Controller
{
    	use TahaControllerTrait;

	private $page = [];

	public function __construct()
	{
	}

	public function searchPanel($request_branch)
	{
		//Security...
		if(!Auth::user()->can("posts-$request_branch.browse"))
			return view('errors.403');

		//Model...
		$db = Post::first() ;
		$branch = Branch::selectBySlug($request_branch);

		//Page Construction...
		$page = $this->page ;
		$page[0] = ["posts/".$request_branch , $branch->title() , 'search'] ;
		$page[1] = ["$request_branch/search" , trans("forms.button.search") , "$request_branch/search"] ;

		//View...
		return view("manage.posts.search" , compact('page' , 'db' , 'branch'));

	}

	public function searchResult(Requests\Manage\PostSearchRequest $request , $request_branch)
	{
		//Security...
		if(!Auth::user()->can("posts-$request_branch.browse"))
			return view('errors.403');

		//Model...
		$db = Post::first() ;
		$branch = Branch::selectBySlug($request_branch);
		$keyword = $request->keyword ;
		$model_data = Post::selector($request_branch , 'all')
				->whereRaw(Post::searchRawQuery($keyword))
				->paginate(50);

		//Page Construction...
		$page = $this->page ;
		$page[0] = ["posts/".$request_branch , $branch->title() , 'search'] ;
		$page[1] = ["$request_branch/search" , trans("forms.button.search") , "$request_branch/search"] ;

		//View...
		return view("manage.posts.browse" , compact('page','branch','model_data' , 'db' , 'keyword'));

	}

	public function browse($request_branch, $request_tab = 'published' , $request_category = 'all')
	{
		//Redirect if $request_branch is a number!
		if(is_numeric($request_branch))
			return $this->modalActions($request_branch , $request_tab) ;

		//Redirect if create
		if($request_tab=='create')
			return $this->create($request_branch);

		//Preconditions...
		switch($request_tab) {
			case 'search':
				$permission = "$request_branch.search" ;
				break;
			case 'published' :
				$permission = "$request_branch";
				break;
			case 'scheduled' :
				$permission = "$request_branch" ;
				break ;
			case 'pending' :
				$permission = "$request_branch" ;
				break;
			case 'drafts' :
				$permission = "$request_branch.publish" ;
				break;
			case 'my_posts' :
				$permission = "$request_branch.create" ;
				break;
			case 'my_drafts' :
				$permission = "$request_branch.create" ;
				break;
			case 'bin' :
				$permission = "$request_branch.bin" ;
				break ;
			default:
				$permission = 'none' ;
		}

		//Permission
		if(!Auth::user()->can('posts-'.$permission))
			return view('errors.403');

		//Preparation...
		$branch = Branch::selectBySlug($request_branch);
		if(!$branch)
			return view('errors.404');

		$page = $this->page ;
		$page[0] = ["posts/".$request_branch , $branch->title() , $request_tab] ;
		$page[1] = ["$request_branch/".$request_tab , trans("posts.manage.$request_tab") , "$request_branch/".$request_tab] ;

		//Categories...
		if($branch->hasFeature('category')) {
			$categories = Category::where('branch_id', $branch->id)->orderBy('title')->get() ;

			$categories_array = [
				[
					$request_category=='all'? 'check' : '',
					trans('posts.categories.all'),
					url("manage/posts/$branch->slug/$request_tab/all")
				],
				[
					$request_category=='without'? 'check' : '',
					trans('posts.categories.withouts'),
					url("manage/posts/$branch->slug/$request_tab/without")
				],
				['-']
			] ;

			foreach($categories as $category) {
				array_push($categories_array , [
					$request_category==$category->slug? 'check' : '' ,
					$category->title ,
					url("manage/posts/$branch->slug/$request_tab/$category->slug") ,
				]);
			}

			if($request_category == 'without') {
				$category_id = '0';
				$category_label = trans('posts.categories.withouts');
			}
			elseif($request_category == 'all') {
				$category_id = 'all';
				$category_label = trans('posts.categories.all');
			}
			elseif($request_category) {
				$category = Category::where('branch_id', $branch->id)->where('slug', $request_category)->first();
				if($category) {
					$category_id = $category->id;
					$category_label = $category->title ;
				}
				else
					return view('errors.404');;
			}
			else {
				$category_id = 'all';
			}
		}
		else
			$category_id = 'all' ;

		//Model...
		$model_data = Post::selector($request_branch, $request_tab , $category_id)->orderBy('created_at' , 'desc')->paginate(50);
		$db = Post::first() ;

		//View...
		return view("manage.posts.browse" , compact('page','branch','model_data' , 'db' , 'categories_array' , 'category_label'));

	}

	public function update($model_id)
	{
		$model = Post::withTrashed()->find($model_id);
		$selector = true ;
		if(!$model)
			return view('errors.m410');
		else
			return view('manage.posts.browse-row' , compact('model' , 'selector' , 'module'));
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

	private function create($branch_slug)
	{
		//Model...
		$model = new Post() ;
		$model->branch = $branch_slug ;
		if(!$model->branch())
			return view('errors.410');

		//Permission...
		if(!Auth::user()->can("posts-$branch_slug.create"))
			return view('errors.403');

		//Preparetions...
		$page = $this->page ;
		$page[0] = ["posts/$branch_slug" , $model->branch()->title()] ;
		$page[1] = ["posts/create/$branch_slug" , trans('posts.manage.create' , ['thing' => $model->branch()->title(1)])];

		//View...
		return view('manage.posts.editor' , compact('page', 'model'));

	}

	public function editor($branch_slug , $post_id)
	{
		//Model...
		$model = Post::withTrashed()->find($post_id) ;
		$model->spreadMeta() ;
		$model->loadPhotos() ;

		if(!$model)
			return view('errors.410');

		//Permission...
		if(!$model->canEdit())
			return view('errors.403');

		//Preparations...
		$page = $this->page ;
		$page[0] = ["posts/".$model->branch , $model->branch()->title() ] ;
		$page[1] = ["posts/$post_id/edit" , trans('posts.manage.edit' , ['thing'=>$model->branch()->singular_title]) ] ;

		//View...
		return view('manage.posts.editor' , compact('page','model'));

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

		if(!Auth::user()->can('posts-'.$model->branch.".publish"))
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
	public function save(Requests\Manage\PostSaveRequest $request)
	{
		$data = $request->toArray() ;
		$action = $data['action'] ;
		unset($data['action']);
		unset($data['is_published']);
		$now = Carbon::now()->toDateTimeString();
		$user = Auth::user() ;
		$user_id = $user->id ;
		$success_redirect = null ;
		$branch = Branch::findBySlug($request->branch);

		//Processing Custom Publish Date...
		if($branch->hasFeature('schedule')) {
			if($data['publish_date_mode'] == 'custom') {
				$data['published_at'] = $data['publish_date'];
			}
			else {
				$data['published_at'] = null ;
			}
			unset($data['publish_date']);
			unset($data['publish_date_mode']);
		}
		else {
			$data['published_at'] = null ;
		}

		//if new record...
		if(!$data['id']) {
			$success_redirect = 'manage/posts/'.$data['branch'].'/edit/-ID-/' ;
			switch($action) {
				case 'draft' :
					$data['is_draft'] = 1 ;
					break;

				case 'save' :
					break;

				case 'publish' :
					$data['published_by'] = $user_id ;
					if(!$data['published_at'])
						$data['published_at'] = $now ;
					break;
			}
		}

		//if modified record...
		if($data['id']) {
			$model = Post::find($data['id']);
			if(!$model)
				return $this->jsonFeedback();

			switch($action) {
				case 'draft' :
					if($model->isPublished())
						return $this->jsonFeedback();
					$data['is_draft'] = 1 ;
					break;

				case 'save' :
					$data['is_draft'] = 0 ;
					if($model->isPublished())
						return $this->jsonFeedback();
					break;

				case 'publish' :
					if($model->isPublished()) {
						if(!$model->branch()->hasFeature('schedule'))
							$data['published_at'] = $model->published_at ;
					}
					else {
						$data['published_by'] = $user_id ;
						if(!$data['published_at'])
							$data['published_at'] = $now ;
					}
					break;
			}

		}

		//Stripping unauthorized fields...
		if(!$branch->hasFeature('image'))
			unset($data['featured_image']) ;
		if(!$branch->hasFeature('text'))
			unset($data['text']);
		if(!$branch->hasFeature('abstract'))
			unset($data['abstract']);
		if(!$branch->hasFeature('category'))
			unset($data['category_id']);

		//Gallery...
		if($branch->hasFeature('gallery'))
			$data['post_photos'] = Post::savePhotos($data);

		//Save...
		$is_saved = Post::store($data) ;

		//Saving Meta...
		$post = Post::find($is_saved) ;

		//Making RSS...
		//@TODO: Post RSS

		$success_redirect = str_replace('-ID-' , $is_saved , $success_redirect );
		//Choosing the redirection...

		return $this->jsonAjaxSaveFeedback($is_saved , [
			'success_redirect' => $success_redirect ,
			'success_refresh' => 1 ,
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



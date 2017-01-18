<?php

namespace App\Http\Controllers\Manage;

use App\models\Branch;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
	private $page = array() ;

	public function __construct()
	{
		$this->page[0] = ['index' , trans('manage.index')] ;
	}

	public function index()
	{
		$page = $this->page ;
		$digests = $this->index_digests() ;
		return view('manage.index.index' , compact('page', 'digests'));
	}

	private function index_digests()
	{
		$digests = [] ;

		$branches = Branch::selector('digest')->get();
		$themes = ['orangered' , 'pink' , 'violet' , 'green' , 'primary' , 'red' , 'yellow'] ;
		foreach($branches as $key => $branch) {
			$posts = Post::counter($branch->slug);
			array_push($digests , [
					'icon' => $branch->icon ,
					'number' => number_format($posts),
					'text' => $branch->title(1) ,
					'theme' => $themes[ $key%sizeof($themes) ] ,
					'link' => Auth::user()->can("posts-$branch->slug.browse")? url("/manage/posts/$branch->slug") : 'NO' ,
			]);

		}


		return $digests ;

	}
}

<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
	public function index()
	{

//		$data = [
//			'branch' => 'Foolan' ,
//			'id' => '3' ,
//			'folan' => '124' ,
//		] ;
//
//		echo Post::store($data) ;

		$post = Post::find(3) ;
		$post->spreadMeta() ;

		dd($post->folan) ;
	}
}

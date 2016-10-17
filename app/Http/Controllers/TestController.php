<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
	public function index()
	{

		$post = User::find(2) ;

		dd($post->getRoles()) ;
	}
}

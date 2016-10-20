<?php

namespace App\Http\Controllers;

use App\models\Branch;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
	public function index()
	{
		$user = User::find(5) ;
		$user->spreadMeta() ;

		dd($user->toArray()) ;

	}

}

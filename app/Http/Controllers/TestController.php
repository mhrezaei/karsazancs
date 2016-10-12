<?php

namespace App\Http\Controllers;

use App\models\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
	public function index()
	{
		$model = Branch::first()  ;

		dd($model->allPosts()) ;
	}
}

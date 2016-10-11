<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
		return view('manage.index.index' , compact('page'));
    }
}

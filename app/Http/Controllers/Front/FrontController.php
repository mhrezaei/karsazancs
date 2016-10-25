<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{


	public function index()
	{
		return view('front.index');
	}

	/*
	|--------------------------------------------------------------------------
	| Authentication Related Things
	|--------------------------------------------------------------------------
	| A place to redirect logged user and logoff landing page.
	*/

	public function redirectUsersAfterLogin()
	{
		if(Auth::user()->isAdmin())
			return redirect('/manage') ;
		else
			return redirect('/profile') ;
	}

	public function logout(Request $request)
	{
		$logged_developer = decrypt($request->session()->pull('logged_developer'));

		if($logged_developer) {
			$ok = Auth::loginUsingId( $logged_developer );
			return redirect('/manage') ;
		}

		Auth::logout();
		Session::flush();
		return redirect('/login');
	}

}

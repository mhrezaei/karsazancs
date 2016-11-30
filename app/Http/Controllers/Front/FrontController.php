<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{


	public function index()
	{
		$front_slide = Post::findBySlug('persian_index_about');
		$features = Post::branch('features')->get();
	    return view('front.persian.home.0', compact('front_slide'));
	}

	public function register()
	{
		return 123;
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

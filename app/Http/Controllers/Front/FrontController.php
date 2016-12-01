<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public $global_data;
    public function __construct()
    {
        $this->global_data['header_menu'] = Post::selector('services')->get();
    }

	public function index()
	{
		$data = $this->global_data;
	    $front_slide = Post::findBySlug('persian_index_slide');
		$features = Post::selector('features')->get();
		$services = Post::selector('services')->get();
        $front_about = Post::findBySlug('persian_index_about');
	    return view('front.persian.home.0', compact('front_slide', 'features', 'services', 'front_about', 'data'));
	}

	public function register()
	{
        $data = $this->global_data;
	}

    public function pages($slug, $title = null)
    {
        $data = $this->global_data;
        if (! $slug)
            return view('errors.404');

        if (is_numeric($slug) and $slug > 0)
        {
            $page = Post::findBySlug($slug, 'id');
        }
        else
        {
            $page = Post::findBySlug($slug);
        }

        if (! $page)
            return view('errors.404');

        return view('front.persian.page.0', compact('page', 'data'));
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

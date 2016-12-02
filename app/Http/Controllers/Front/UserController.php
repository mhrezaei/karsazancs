<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Providers\SettingServiceProvider;
use App\Traits\TahaControllerTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use TahaControllerTrait;
    public function __construct()
    {

    }

	public function index()
	{
        return view('errors.404');
	}

	public function profile()
    {
        $user = Auth::user();
        return view('front.persian.user.profile.0', compact('user'));
    }

}

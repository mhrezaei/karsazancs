<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\User;
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

    public function register_confirm($hash)
    {
        if (! $hash)
            return redirect(url(''));

        $user = User::findBySlug($hash, 'remember_token');
        if (!$user)
            return redirect(url(''));

        $update = array(
            'remember_token' => null,
            'id' => $user->id,
        );
        if (strlen($user->code_melli) != 10)
        {
            $update['status'] = 3;
        }
        else
        {
            $update['status'] = 4;
        }

        User::store($update);

        if (! Auth::check())
        {
            Auth::loginUsingId($user->id);
        }
        return redirect(url('/profile'));
    }

    public function user_edit()
    {
        $user = Auth::user();
        return view('front.persian.user.edit.0', compact('user'));
    }

}

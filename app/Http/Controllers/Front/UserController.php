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
use Illuminate\Support\Facades\Hash;
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
            'status' => 3,
        );

        User::store($update);

        if (! Auth::check())
        {
            Auth::loginUsingId($user->id);
        }
        return redirect(url('/user/password'));
    }

    public function user_edit()
    {
        $user = Auth::user();
        return view('front.persian.user.edit.0', compact('user'));
    }

    public function user_password()
    {
        return view('auth.set_password');
    }

    public function user_password_set(Requests\Front\AccountSetPasswordRequest $request)
    {
        $input = $request->toArray();
        $update['password'] = Hash::make($input['password']);
        $update['id'] = Auth::user()->id;
        if (User::store($update))
        {
            return $this->jsonFeedback(null, [
                'redirect' => url('/profile'),
                'ok' => 1,
                'message' => trans('forms.feed.done'),
            ]);
        }
        else
        {
            return $this->jsonFeedback(null, [
                'ok' => 0,
                'message' => trans('forms.feed.error'),
            ]);
        }
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Providers\EmailServiceProvider;
use App\Providers\ValidationServiceProvider;
use App\Models\User;
use App\Traits\TahaControllerTrait;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use TahaControllerTrait;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data = $this->all($data);

        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $user = User::where('email', $data['email'])->first();
            if ($user)
            {
                if ($user->status >= 3)
                {
                    return $this->jsonFeedback(trans('front.unique_email'),[
                        'ok' => 0,
                        'message' => trans('front.unique_email')
                    ]);
                }
                else
                {
                    $update = array(
                        'name_first' => $data['name_first'],
                        'name_last' => $data['name_last'],
                        'email' => $data['email'],
                        'mobile' => $data['mobile'],
                        'status' => 2,
                        'remember_token' => md5($data['email']) . rand(10000, 99999),
                        'id' => $user->id,
                    );
                    User::store($update);
                    $user = User::find($user->id);
                    Auth::loginUsingId($user->id);
                    EmailServiceProvider::send($user, $user->email, trans('front.verify_email'), trans('front.site_title'));
                    return $this->jsonFeedback(null, [
                        'redirect' => url('/profile'),
                        'ok' => 1,
                        'message' => trans('forms.feed.wait'),
                    ]);
                }
            }
        }

        return Validator::make($data, [
            'name_first' => 'required|persian:60|min:2|max:255',
            'name_last' => 'required|persian:60|min:2|max:255',
            'email' => 'required|email|max:255|unique:users',
//            'email' => 'required|email|max:255|unique:users', //@TODO chon sabtename makhfi darim nemitoone unique bashe
            'mobile' => 'required|phone:mobile' ,
            'g-recaptcha-response' => 'required', 'recaptcha',
            //'password' => 'required|min:6|confirmed',
        ]);
    }

    public function all($data)
    {
        $value	= $data;
        $purified = ValidationServiceProvider::purifier($value,[
            'name_first'  =>  'pd',
            'name_last'  =>  'pd',
            'email'  =>  'ed',
            'mobile' => 'ed' ,
        ]);
        return $purified;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $create = User::create([
            'name_first' => $data['name_first'],
            'name_last' => $data['name_last'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'status' => 2,
            'remember_token' => md5($data['email']) . rand(10000, 99999),
//            'password' => bcrypt($data['password']),
        ]);

        $user = $create->toArray();
        if (isset($user['id']) and $user['id'] > 0)
        {
            $user = User::find($user['id']);
            EmailServiceProvider::send($user, $user->email, trans('front.verify_email'), trans('front.site_title'));
            return $this->jsonFeedback(null, [
                'redirect' => url('/profile'),
                'ok' => 1,
                'message' => trans('forms.feed.wait'),
            ]);
        }
        else
        {
            return $this->jsonFeedback(trans('forms.feed.error'),[
                'ok' => 0,
                'message' => trans('forms.feed.error')
            ]);
        }
    }
}

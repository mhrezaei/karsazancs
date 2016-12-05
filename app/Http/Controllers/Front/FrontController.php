<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\User;
use App\Providers\EmailServiceProvider;
use App\Providers\SettingServiceProvider;
use App\Traits\TahaControllerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    use TahaControllerTrait;
    public function __construct()
    {

    }

	public function index()
	{
	    $front_slide = Post::findBySlug('persian_index_slide');
		$features = Post::selector('features')->get();
		$services = Post::selector('services')->get();
        $front_about = Post::findBySlug('persian_index_about');
	    return view('front.persian.home.0', compact('front_slide', 'features', 'services', 'front_about'));
	}

	public function register(Requests\Front\AccountSaveRequest $request)
	{
        $data = $request->toArray();
	    if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            $user = User::where('email', $data['email'])->first();
            if ($user)
            {
                if ($user->status >= 3) {
                    return $this->jsonFeedback(trans('front.unique_email'),[
                        'ok' => 0,
                        'message' => trans('front.unique_email')
                    ]);
                } else {
                    $update = array(
                        'name_first' => $data['name_first'],
                        'name_last' => $data['name_last'],
                        'email' => $data['email'],
                        'mobile' => $data['mobile'],
                        'status' => 2,
                        'remember_token' => md5($data['email']) . rand(10000, 99999),
                        'customer_type' => 1,
                        'id' => $user->id,
                    );
                    User::store($update);
                    $user = User::find($user->id);
                    //Auth::loginUsingId($user->id);
                    EmailServiceProvider::send($user, $user->email, trans('front.verify_email'), trans('front.site_title'), 'user_register_active_link');
                    return $this->jsonFeedback(null, [
                        //'redirect' => url('/profile'),
                        'ok' => 1,
                        'message' => trans('front.please_verify_your_email_address'),
                    ]);
                }
            }
            else
            {
                $insert = array(
                    'name_first' => $data['name_first'],
                    'name_last' => $data['name_last'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'status' => 2,
                    'remember_token' => md5($data['email']) . rand(10000, 99999),
                    'customer_type' => 1,
                );
                $user = User::find(User::store($insert));
                //Auth::loginUsingId($user->id);
                EmailServiceProvider::send($user, $user->email, trans('front.verify_email'), trans('front.site_title'), 'user_register_active_link');
                return $this->jsonFeedback(null, [
                    //'redirect' => url('/profile'),
                    'ok' => 1,
                    'message' => trans('front.please_verify_your_email_address'),
                ]);
            }
        }
        else
        {
            return $this->jsonFeedback(null, [
                'ok' => 0,
                'message' => trans('forms.feed.error'),
            ]);
        }
	}

    public function pages($slug, $title = null)
    {
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

        return view('front.persian.page.0', compact('page'));
	}

    public function contact()
    {
        return view('front.persian.contact.0');
    }

    public function faq()
    {
        $faq = Post::selector('faq')->orderBy('title', 'asc')->get();
        return view('front.persian.faq.0', compact('faq'));
    }

    public function news()
    {
        $news = Post::selector('news')
            ->where('published_at', '<=', Carbon::now()->toDateTimeString())
            ->orderBy('published_at', 'desc')
            ->paginate(20);
        return view('front.persian.news.0', compact('news'));
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
		if ($request->session()->get('logged_developer'))
        {
            $logged_developer = decrypt($request->session()->pull('logged_developer'));

            if($logged_developer) {
                $ok = Auth::loginUsingId( $logged_developer );
                return redirect('/manage') ;
            }
        }

		Auth::logout();
		Session::flush();
		return redirect('/login');
	}

    public function test()
    {
        return view('hadi.test');
	}

    public function test2()
    {
        $data = request()->file('avatar')->store('upload/document');
        dd($data);
	}

}

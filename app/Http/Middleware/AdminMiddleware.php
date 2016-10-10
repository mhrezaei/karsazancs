<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class AdminMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle($request, Closure $next , $permits='')
	{
		if(!$this->check($permits)) {
			if($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized.', 401);
			}
			else {
				return new Response(view('errors.403'));
				return view('errors.403');
			}
		}

		return $next($request);
	}

	private function check($permits)
	{

		$logged_user = Auth::user() ;
		if(!$logged_user or !$logged_user->isAdmin())
			return false ;

		if($permits) {
			return true ; //@TOOD: implement Auth::user()->can()
		}
		else
			return true ;

	}
}

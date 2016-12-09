<?php

namespace App\Http\Middleware;

use App\Traits\GlobalControllerTrait;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class UserIpDetect
{
    use GlobalControllerTrait;
    public function handle($request, Closure $next)
    {
        $user_ip = \Request::ip();
        if ($user_ip != '::1')
        {
            $data = file_get_contents('http://freegeoip.net/json/' . $user_ip);
            if ($data)
            {
                $data = json_decode($data, true);
                if ($data['country_code'] == 'IR')
                {
                    Session::put('domain', 'fa');
                    App::setLocale('fa');
                }
                else
                {
                    Session::put('domain', 'en');
                    App::setLocale('en');
                }
            }
        }
        return $next($request);
    }
}

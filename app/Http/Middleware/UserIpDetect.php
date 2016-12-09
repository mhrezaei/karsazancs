<?php

namespace App\Http\Middleware;

use App\Providers\SettingServiceProvider;
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
                    {
                    }
                    else
                    {
                        $this->setData('fa');
                    }
                }
                else
                {
                    {
                    }
                    else
                    {
                    }
                }
            }
        }
        return $next($request);
    }

    public function setData($lang)
    {
        Session::put('domain', $lang);
        App::setLocale($lang);
    }
}

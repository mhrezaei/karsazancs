<?php

namespace App\Http\Middleware;

use App\Providers\SettingServiceProvider;
use App\Traits\GlobalControllerTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class UserIpDetect
{
    use GlobalControllerTrait;
    public function handle($request, Closure $next)
    {
        $user_ip = \Request::ip();
        $use_ip = SettingServiceProvider::get('use_ip');
        if ($user_ip != '::1' and $use_ip)
        {
            $data = file_get_contents('http://freegeoip.net/json/' . $user_ip);
            if ($data)
            {
                $data = json_decode($data, true);
                if ($data['country_code'] == 'IR')
                {
                    if ($this->getDomain())
                    {
                        $this->setData($this->getDomain());
                    }
                    else
                    {
                        $this->setData('fa');
                    }
                }
                else
                {
                    if ($this->getDomain())
                    {
                        $this->setData($this->getDomain());
                    }
                    else
                    {
                        $this->setData('en');
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

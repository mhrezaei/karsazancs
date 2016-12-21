<?php
namespace App\Traits;


use Illuminate\Support\Facades\Session;

trait GlobalControllerTrait
{
    public function getDomain()
    {
        $subdomain = str_replace('http://', '', url(''));
        $subdomain = str_replace('https://', '', $subdomain);
        $subdomain = explode('.', $subdomain);
        $result = null;
        if (strpos('localhost', $subdomain[0]))
        {
            if ($subdomain[0] == 'www')
            {
                if ($subdomain[1] == 'fa')
                {
                    $result = 'fa';
                }
                elseif ($subdomain[1] == 'en')
                {
                    $result = 'en';
                }
            }
            else
            {
                if ($subdomain[0] == 'fa')
                {
                    $result = 'fa';
                }
                elseif ($subdomain[0] == 'en')
                {
                    $result = 'en';
                }
            }
        }
        else
        {
            $result = 'fa';
        }

        $subdomain = 'en';
        return $result;
    }

    public static function domain()
    {
        if (Session::has('domain'))
        {
            return Session::get('domain');
        }
        else
        {
            return 'fa';
        }
    }
}
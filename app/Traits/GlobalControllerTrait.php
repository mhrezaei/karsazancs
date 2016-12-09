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
        if ($subdomain[0] == 'www')
        {
            if ($subdomain[1] == 'diamondecard' or $subdomain[1] == 'localhost')
            {
                $subdomain = 'fa';
            }
            else
            {
                if ($subdomain[1] == 'fa')
                {
                    $subdomain = 'fa';
                }
                elseif ($subdomain[1] == 'en')
                {
                    $subdomain = 'en';
                }
                else
                {
                    $subdomain = 'fa';
                }
            }
        }
        else
        {
            if ($subdomain[0] == 'diamondecard' or $subdomain[0] == 'localhost')
            {
                $subdomain = 'fa';
            }
            else
            {
                if ($subdomain[0] == 'fa')
                {
                    $subdomain = 'fa';
                }
                elseif ($subdomain[0] == 'en')
                {
                    $subdomain = 'en';
                }
                else
                {
                    $subdomain = 'fa';
                }
            }
        }

        $subdomain = 'en';
        return $subdomain;
    }

    public function domain()
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
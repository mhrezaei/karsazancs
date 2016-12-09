<?php

namespace App\Http\Middleware;

use App\Models\Domain;
use App\Traits\GlobalControllerTrait;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Subdomain
{
    use GlobalControllerTrait;
    public function handle($request, Closure $next)
    {
        if ($this->getDomain())
        {
            Session::put('domain', $this->getDomain());
            App::setLocale($this->getDomain());
        }
        return $next($request);
    }
}

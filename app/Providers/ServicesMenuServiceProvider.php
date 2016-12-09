<?php

namespace App\Providers;

use App\Models\Post;
use App\Traits\GlobalControllerTrait;
use Illuminate\Support\ServiceProvider;

class ServicesMenuServiceProvider extends ServiceProvider
{
    use GlobalControllerTrait;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public static function get()
    {
        return Post::selector(self::domain() . '-services')->get();
    }
}

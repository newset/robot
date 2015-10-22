<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\Inseed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->registerInseed();
        $this->app['inseed'] = $this->app->share(function($app)
        {
            return new Inseed;
        });
        
        $this->commands(
            'inseed'
        );
    }
}

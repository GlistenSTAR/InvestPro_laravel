<?php

namespace App\Providers;

use App\General;
use App\Menu;
use App\Social;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('general', General::first());
        view()->share('social', Social::get());
        view()->share('frontMenu', Menu::get());
    }
}

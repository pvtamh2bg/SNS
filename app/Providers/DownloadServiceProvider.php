<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\DownloadImg;


class DownloadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(DownloadImg::class, function($app) {
            return new DownloadImg();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

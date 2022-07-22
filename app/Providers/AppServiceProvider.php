<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Auth;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        Blade::if('admin', function () {
            return auth()->user()->utype === 'ADM';
        });
        Blade::if('manager', function () {
            return auth()->user()->utype === 'ADM' || auth()->user()->utype === 'MAN';
        });
        Blade::if('employee', function () {
            return auth()->user()->utype === 'ADM' || auth()->user()->utype === 'MAN' || auth()->user()->utype === 'EMP';
        });
        ini_set("memory_limit", "100M");
        ini_set('post_max_size', '50M');
        ini_set('upload_max_filesize', '50M');
    
    }
}

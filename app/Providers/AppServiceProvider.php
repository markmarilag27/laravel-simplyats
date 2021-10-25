<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        // @link https://laravel.com/docs/8.x/configuration#determining-the-current-environment
        if ($this->app->environment('local')) {
            // @link https://github.com/barryvdh/laravel-ide-helper
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            // https://laravel.com/docs/8.x/telescope#local-only-installation
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // @link https://laravel.com/docs/8.x/migrations#index-lengths-mysql-mariadb
        Schema::defaultStringLength(191);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('formatted_number', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[0-9,]+$/', $value);
        });

        Paginator::useBootstrap();
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\TitleComposer;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', TitleComposer::class);

        Validator::extend('username', function ($attribute, $value, $parameters, $validator) {
            // Your custom validation logic for username goes here
            // For example:
            return preg_match('/^[a-zA-Z0-9_]+$/', $value);
        });
    }

    public function register()
    {
        //
    }
}
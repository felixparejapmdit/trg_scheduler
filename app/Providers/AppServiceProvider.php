<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\TitleComposer;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Illuminate\Support\Facades\URL::forceScheme('https');
        View::composer('*', TitleComposer::class);
    }

    public function register()
    {
        //
    }
}

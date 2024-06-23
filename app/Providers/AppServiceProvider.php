<?php

namespace App\Providers;
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\TitleComposer;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', TitleComposer::class);
    }

    public function register()
    {
        //
    }
}
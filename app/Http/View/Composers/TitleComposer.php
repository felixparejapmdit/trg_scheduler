<?php


namespace App\Http\View\Composers;

use Illuminate\View\View;

class TitleComposer
{
    public function compose(View $view)
    {
        $view->with('title', 'TRG Scheduler');
    }
}
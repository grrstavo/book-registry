<?php

namespace BookRegistry\Autor\Provider;

use BookRegistry\Autor\Listener\ReportRequestedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AutorEventProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Event::subscribe(ReportRequestedListener::class);
    }
}

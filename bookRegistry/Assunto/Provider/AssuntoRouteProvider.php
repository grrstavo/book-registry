<?php

namespace BookRegistry\Assunto\Provider;

use BookRegistry\Assunto\Http\Controller\AssuntoController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class AssuntoRouteProvider extends RouteServiceProvider
{
    /**
     * Define the routes for the Assunto module.
     *
     * @return void
     */
    public function map(): void
    {
        Route::post('/assuntos', [AssuntoController::class, 'store'])->name('assuntos.store');
    }
}

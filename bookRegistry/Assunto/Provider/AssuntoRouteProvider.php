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
        Route::middleware('web')->group(function () {
            Route::post('/assuntos', [AssuntoController::class, 'store'])->name('assuntos.store');
            Route::get('/assuntos', [AssuntoController::class, 'index'])->name('assuntos.index');
            Route::get('/assuntos/create', [AssuntoController::class, 'create'])->name('assuntos.create');
        });
    }
}

<?php

namespace BookRegistry\Autor\Provider;

use BookRegistry\Autor\Http\Controller\AutorController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class AutorRouteProvider extends RouteServiceProvider
{
    /**
     * Define the routes for the Autor module.
     *
     * @return void
     */
    public function map(): void
    {
        Route::middleware('web')->group(function () {
            Route::post('/autores', [AutorController::class, 'store'])->name('autores.store');
            Route::get('/autores', [AutorController::class, 'index'])->name('autores.index');
            Route::get('/autores/create', [AutorController::class, 'create'])->name('autores.create');
            Route::get('/autores/{codAu}/edit', [AutorController::class, 'edit'])->name('autores.edit');
            Route::put('/autores/{codAu}', [AutorController::class, 'update'])->name('autores.update');
        });
    }
}

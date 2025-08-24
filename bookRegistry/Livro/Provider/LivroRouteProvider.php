<?php

namespace BookRegistry\Livro\Provider;

use BookRegistry\Livro\Http\Controller\LivroController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class LivroRouteProvider extends RouteServiceProvider
{
    /**
     * Define the routes for the Livro module.
     *
     * @return void
     */
    public function map(): void
    {
        Route::middleware('web')->group(function () {
            Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
            Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
            Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
            Route::get('/livros/{codl}/edit', [LivroController::class, 'edit'])->name('livros.edit');
            Route::put('/livros/{codl}', [LivroController::class, 'update'])->name('livros.update');
        });
    }
}

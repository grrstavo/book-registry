<?php

namespace BookRegistry\Livro\Provider;

use BookRegistry\Livro\Domain\Repository\LivroRepositoryInterface;
use BookRegistry\Livro\Infrastructure\Repository\LivroRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class LivroRepositoryProvider extends RouteServiceProvider
{
    /**
     * Repository bindings for the Livro module.
     *
     * @var array
     */
    public $bindings = [
        LivroRepositoryInterface::class => LivroRepository::class,
    ];
}

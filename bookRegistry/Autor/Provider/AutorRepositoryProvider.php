<?php

namespace BookRegistry\Autor\Provider;

use BookRegistry\Autor\Domain\Repository\AutorRepositoryInterface;
use BookRegistry\Autor\Infrastructure\Repository\AutorRepository;
use Illuminate\Support\ServiceProvider;

class AutorRepositoryProvider extends ServiceProvider
{
    /**
     * Repository bindings for the Autor module.
     *
     * @var array
     */
    public $bindings = [
        AutorRepositoryInterface::class => AutorRepository::class,
    ];
}

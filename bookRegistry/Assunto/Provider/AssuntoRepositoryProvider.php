<?php

namespace BookRegistry\Assunto\Provider;

use BookRegistry\Assunto\Domain\Repository\AssuntoRepositoryInterface;
use BookRegistry\Assunto\Infrastructure\Repository\AssuntoRepository;
use Illuminate\Support\ServiceProvider;

class AssuntoRepositoryProvider extends ServiceProvider
{
    /**
     * Repository bindings for the Assunto module.
     *
     * @var array
     */
    public $bindings = [
        AssuntoRepositoryInterface::class => AssuntoRepository::class,
    ];
}

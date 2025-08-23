<?php

namespace BookRegistry\Assunto\Domain\Repository;

use BookRegistry\Assunto\Domain\Model\Assunto;

interface AssuntoRepositoryInterface
{
    /**
     * Create a new Assunto.
     *
     * @param Assunto $assunto
     * @return void
     */
    public function create(Assunto $assunto): void;
}

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

    /**
     * Update an Assunto.
     *
     * @param Assunto $assunto
     * @param int $codAs
     * @return void
     */
    public function update(Assunto $assunto, int $codAs): void;
}

<?php

namespace BookRegistry\Autor\Domain\Repository;

use BookRegistry\Autor\Domain\Model\Autor;

interface AutorRepositoryInterface
{
    /**
     * Create a new Autor.
     *
     * @param Autor $autor
     * @return void
     */
    public function create(Autor $autor): void;

    /**
     * Update an Autor.
     *
     * @param Autor $autor
     * @param int $codAu
     * @return void
     */
    public function update(Autor $autor, int $codAu): void;

    /**
     * Find an Autor by its CodAu.
     *
     * @param int $codAu
     * @return Autor|null
     */
    public function findByCodAu(int $codAu): ?Autor;

    /**
     * Delete an Autor.
     *
     * @param int $codAu
     */
    public function delete(int $codAu): void;
}

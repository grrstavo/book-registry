<?php

namespace BookRegistry\Livro\Domain\Repository;

use BookRegistry\Livro\Domain\Model\Livro;

interface LivroRepositoryInterface
{
    /**
     * Create a new Livro.
     *
     * @param Livro $autor
     * @return void
     */
    public function create(Livro $autor): void;

    /**
     * Update an Livro.
     *
     * @param Livro $autor
     * @param int $codl
     * @return void
     */
    public function update(Livro $autor, int $codl): void;

    /**
     * Find an Livro by its Codl.
     *
     * @param int $codl
     * @return Livro|null
     */
    public function findByCodl(int $codl): ?Livro;

    /**
     * Delete a Livro.
     *
     * @param int $codl
     * @return void
     */
    public function delete(int $codl): void;
}

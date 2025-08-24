<?php

namespace BookRegistry\Livro\Domain\Repository;

use BookRegistry\Livro\Domain\Model\Livro;
use DomainException;

class LivroRepository
{
    /**
     * @param LivroRepositoryInterface $repository
     */
    public function __construct(
        private LivroRepositoryInterface $repository
    ) {
    }

    /**
     * Create a new Livro.
     *
     * @param Livro $payload
     * @return Livro
     */
    public function create(Livro $livro): void
    {
        if (isset($livro->Codl)) {
            throw new DomainException('O livro não pode ser criado pois já tem código');
        }

        $this->repository->create($livro);
    }

    /**
     * Update an Livro.
     *
     * @param Livro $livro
     * @param int $codl
     * @return void
     */
    public function update(Livro $livro, int $codl): void
    {
        if (!$codl) {
            throw new DomainException('O livro não pode ser editado pois não tem código');
        }

        if (!$this->repository->findByCodl($codl)) {
            throw new DomainException('O livro não pode ser editado pois não existe');
        }

        $this->repository->update($livro, $codl);
    }
}

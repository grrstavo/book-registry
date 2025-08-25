<?php

namespace BookRegistry\Autor\Domain\Repository;

use BookRegistry\Autor\Domain\Model\Autor;
use DomainException;

class AutorRepository
{
    /**
     * @param AutorRepositoryInterface $repository
     */
    public function __construct(
        private AutorRepositoryInterface $repository
    ) {
    }

    /**
     * Create a new Autor.
     *
     * @param Autor $payload
     * @return Autor
     */
    public function create(Autor $autor): void
    {
        if (isset($autor->CodAu)) {
            throw new DomainException('O autor não pode ser criado pois já tem código');
        }

        $this->repository->create($autor);
    }

    /**
     * Update an Autor.
     *
     * @param Autor $autor
     * @param int $codAu
     * @return void
     */
    public function update(Autor $autor, int $codAu): void
    {
        if (!$codAu) {
            throw new DomainException('O autor não pode ser editado pois não tem código');
        }

        if (!$this->repository->findByCodAu($codAu)) {
            throw new DomainException('O autor não pode ser editado pois não existe');
        }

        $this->repository->update($autor, $codAu);
    }

    /**
     * Delete an Autor.
     *
     * @param Autor $autor
     */
    public function delete(int $codAu): void
    {
        if (!$this->repository->findByCodAu($codAu)) {
            throw new DomainException('O autor não pode ser deletado pois não existe');
        }

        $this->repository->delete($codAu);
    }
}

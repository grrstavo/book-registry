<?php

namespace BookRegistry\Assunto\Domain\Repository;

use BookRegistry\Assunto\Domain\Model\Assunto;
use DomainException;

class AssuntoRepository
{
    /**
     * @param AssuntoRepositoryInterface $repository
     */
    public function __construct(
        private AssuntoRepositoryInterface $repository
    ) {
    }

    /**
     * Create a new Assunto.
     *
     * @param Assunto $payload
     * @return Assunto
     */
    public function create(Assunto $assunto): void
    {
        if (isset($assunto->codAs)) {
            throw new DomainException('O assunto não pode ser criado pois já tem código');
        }

        $this->repository->create($assunto);
    }

    /**
     * Update an Assunto.
     *
     * @param Assunto $assunto
     * @param int @codAs
     * @return void
     */
    public function update(Assunto $assunto, int $codAs): void
    {
        if (!$codAs) {
            throw new DomainException('O assunto não pode ser editado pois não tem código');
        }

        if (!Assunto::find($codAs)->exists()) {
            throw new DomainException('O assunto não pode ser editado pois não existe');
        }

        $this->repository->update($assunto, $codAs);
    }
}

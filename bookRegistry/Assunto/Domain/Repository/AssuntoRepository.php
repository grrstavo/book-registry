<?php

namespace BookRegistry\Assunto\Domain\Repository;

use BookRegistry\Assunto\Domain\Model\Assunto;
use DomainException;

class AssuntoRepository
{
    /**
     * @param AssuntoRepositoryInterface $dao
     */
    public function __construct(
        private AssuntoRepositoryInterface $dao
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

        $this->dao->create($assunto);
    }
}

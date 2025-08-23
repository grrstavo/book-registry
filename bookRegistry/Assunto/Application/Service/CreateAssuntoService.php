<?php

namespace BookRegistry\Assunto\Application\Service;

use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepositoryInterface;

class CreateAssuntoService
{
    /**
     * @param AssuntoRepository $repository
     */
    public function __construct(
        private AssuntoRepositoryInterface $repository
    ) {
    }

    /**
     * Handle the creation of a new Assunto.
     *
     * @param AssuntoDTO $dto
     * @return void
     */
    public function __invoke(AssuntoDTO $dto): void
    {
        $this->repository->create($dto->toAssunto());
    }
}

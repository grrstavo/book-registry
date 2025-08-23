<?php

namespace BookRegistry\Assunto\Application\Service;

use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepository;

class UpdateAssuntoService
{
    /**
     * @param AssuntoRepository $repository
     */
    public function __construct(
        private AssuntoRepository $repository
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
        $this->repository->update(assunto: $dto->toAssunto(), codAs: $dto->codAs);
    }
}

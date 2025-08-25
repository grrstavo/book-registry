<?php

namespace BookRegistry\Assunto\Application\Service;

use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepository;

class DeleteAssuntoService
{
    /**
     * @param AssuntoRepository $repository
     */
    public function __construct(
        private AssuntoRepository $repository
    ) {
    }

    /**
     * Handle the deletion of an Assunto
     *
     * @param int $codAu
     * @return void
     */
    public function __invoke(int $codAu): void
    {
        $this->repository->delete($codAu);
    }
}

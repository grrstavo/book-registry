<?php

namespace BookRegistry\Autor\Application\Service;

use BookRegistry\Autor\Domain\DTO\AutorDTO;
use BookRegistry\Autor\Domain\Repository\AutorRepository;

class DeleteAutorService
{
    /**
     * @param AutorRepository $repository
     */
    public function __construct(
        private AutorRepository $repository
    ) {
    }

    /**
     * Handle the creation of a new Autor.
     *
     * @param int $codAu
     * @return void
     */
    public function __invoke(int $codAu): void
    {
        $this->repository->delete($codAu);
    }
}

<?php

namespace BookRegistry\Autor\Application\Service;

use BookRegistry\Autor\Domain\DTO\AutorDTO;
use BookRegistry\Autor\Domain\Repository\AutorRepository;

class UpdateAutorService
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
     * @param AutorDTO $dto
     * @return void
     */
    public function __invoke(AutorDTO $dto): void
    {
        $this->repository->update(autor: $dto->toAutor(), codAu: $dto->codAu);
    }
}

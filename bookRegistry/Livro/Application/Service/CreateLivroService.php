<?php

namespace BookRegistry\Livro\Application\Service;

use BookRegistry\Livro\Domain\DTO\LivroDTO;
use BookRegistry\Livro\Domain\Repository\LivroRepository;

class CreateLivroService
{
    /**
     * @param LivroRepository $repository
     */
    public function __construct(
        private LivroRepository $repository
    ) {
    }

    /**
     * Handle the creation of a new Livro.
     *
     * @param LivroDTO $dto
     * @return void
     */
    public function __invoke(LivroDTO $dto): void
    {
        $this->repository->create($dto->toLivro());
    }
}

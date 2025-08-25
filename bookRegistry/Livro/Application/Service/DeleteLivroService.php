<?php

namespace BookRegistry\Livro\Application\Service;

use BookRegistry\Livro\Domain\DTO\LivroDTO;
use BookRegistry\Livro\Domain\Repository\LivroRepository;

class DeleteLivroService
{
    /**
     * @param LivroRepository $repository
     */
    public function __construct(
        private LivroRepository $repository
    ) {
    }

    /**
     * Handle the deletion of a Livro.
     *
     * @param int $codl
     * @return void
     */
    public function __invoke(int $codl): void
    {
        $this->repository->delete($codl);
    }
}

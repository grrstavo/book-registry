<?php

namespace BookRegistry\Autor\Infrastructure\Repository;

use BookRegistry\Autor\Domain\Model\Autor;
use BookRegistry\Autor\Domain\Repository\AutorRepositoryInterface;

class AutorRepository implements AutorRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(Autor $autor): void
    {
        Autor::query()->create([
            'Nome' => $autor->Nome
        ]);
    }

    /**
     * @inheritDoc
     */
    public function update(Autor $autor, int $codAu): void
    {
        $existingAutor = $this->findByCodAu($codAu);
        $existingAutor->Nome = $autor->Nome;
        $existingAutor->save();
    }

    /**
     * @inheritDoc
     */
    public function findByCodAu(int $codAu): ?Autor
    {
        return Autor::find($codAu);
    }
}

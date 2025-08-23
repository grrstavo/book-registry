<?php

namespace BookRegistry\Assunto\Infrastructure\Repository;

use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepositoryInterface;

class AssuntoRepository implements AssuntoRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(Assunto $assunto): void
    {
        Assunto::query()->create([
            'Descricao' => $assunto->Descricao
        ]);
    }

    /**
     * @inheritDoc
     */
    public function update(Assunto $assunto, int $codAs): void
    {
        $existingAssunto = $this->findByCodAs($codAs);
        $existingAssunto->Descricao = $assunto->Descricao;
        $existingAssunto->save();
    }

    /**
     * @inheritDoc
     */
    public function findByCodAs(int $codAs): ?Assunto
    {
        return Assunto::find($codAs);
    }
}

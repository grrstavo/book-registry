<?php

namespace BookRegistry\Assunto\Infrastructure\Repository;

use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepositoryInterface;

class AssuntoRepository implements AssuntoRepositoryInterface
{
    /**
     * Create a new Assunto.
     *
     * @param Assunto $assunto
     * @return void
     */
    public function create(Assunto $assunto): void
    {
        $a = Assunto::query()->create([
            'Descricao' => $assunto->Descricao
        ]);
    }
}

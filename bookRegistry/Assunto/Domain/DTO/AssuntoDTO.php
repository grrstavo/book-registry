<?php

namespace BookRegistry\Assunto\Domain\DTO;

use BookRegistry\Assunto\Domain\Model\Assunto;

readonly class AssuntoDTO
{
    /**
     * Create a new AssuntoDTO instance.
     *
     * @param int|null $codAs
     * @param string $Descricao
     */
    public function __construct(
        public string $Descricao,
        public int|null $codAs = null
    ) {
    }

    /**
     * Convert the DTO to an Assunto entity.
     *
     * @return Assunto
     */
    public function toAssunto(): Assunto
    {
        return new Assunto([
            'Descricao' => $this->Descricao
        ]);
    }
}

<?php

namespace BookRegistry\Autor\Domain\DTO;

use BookRegistry\Autor\Domain\Model\Autor;

readonly class AutorDTO
{
    /**
     * Create a new AutorDTO instance.
     *
     * @param int|null $codAu
     * @param string $nome
     */
    public function __construct(
        public string|null $nome = null,
        public int|null $codAu = null
    ) {
    }

    /**
     * Convert the DTO to an Autor entity.
     *
     * @return Autor
     */
    public function toAutor(): Autor
    {
        return new Autor([
            'Nome' => $this->nome
        ]);
    }
}

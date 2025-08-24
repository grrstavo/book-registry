<?php

namespace BookRegistry\Livro\Domain\DTO;

use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use BookRegistry\Livro\Domain\Model\Livro;
use Illuminate\Support\Collection;

readonly class LivroDTO
{
    /**
     * Create a new LivroDTO instance.
     *
     * @param string $titulo
     * @param string $editora
     * @param int $edicao
     * @param int $anoPublicacao
     * @param int $valor
     */
    public function __construct(
        public string|null $titulo = null,
        public string|null $editora = null,
        public int|null $edicao = null,
        public int|null $anoPublicacao = null,
        public int|null $valor = null,
        public int|null $codl = null,
        public array|null $assuntos = null,
        public array|null $autores = null,
    ) {
    }

    /**
     * Convert the DTO to an Livro entity.
     *
     * @return Livro
     */
    public function toLivro(): Livro
    {
        $livro = new Livro([
            'Titulo' => $this->titulo,
            'Editora' => $this->editora,
            'Edicao' => $this->edicao,
            'AnoPublicacao' => $this->anoPublicacao,
            'Valor' => $this->valor,
        ]);

        $assuntos = new Collection($this->assuntos);
        $autores = new Collection($this->autores);

        $livro->setRelation('assuntosCollection', $assuntos);
        $livro->setRelation('autoresCollection', $autores);

        return $livro;
    }
}

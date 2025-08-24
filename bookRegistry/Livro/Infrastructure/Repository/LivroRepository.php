<?php

namespace BookRegistry\Livro\Infrastructure\Repository;

use BookRegistry\Livro\Domain\Model\Livro;
use BookRegistry\Livro\Domain\Repository\LivroRepositoryInterface;
use Illuminate\Support\Collection;

class LivroRepository implements LivroRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findByCodl(int $codl): ?Livro
    {
        return Livro::find($codl);
    }

    /**
     * @inheritDoc
     */
    public function create(Livro $livro): void
    {
        $livroCreated = Livro::query()->create([
            'Titulo' => $livro->Titulo,
            'Editora' => $livro->Editora,
            'Edicao' => $livro->Edicao,
            'AnoPublicacao' => $livro->AnoPublicacao,
            'Valor' => $livro->Valor,
        ]);

        if ($livro->relationLoaded('autoresCollection')) {
            $this->syncAutores($livroCreated, $livro->autoresCollection);
        }

        if ($livro->relationLoaded('assuntosCollection')) {
            $this->syncAssuntos($livroCreated, $livro->assuntosCollection);
        }
    }

    /**
     * @inheritDoc
     */
    public function update(Livro $livro, int $codl): void
    {
        $existingLivro = $this->findByCodl($codl);
        $existingLivro->Titulo = $livro->Titulo;
        $existingLivro->Editora = $livro->Editora;
        $existingLivro->Edicao = $livro->Edicao;
        $existingLivro->AnoPublicacao = $livro->AnoPublicacao;
        $existingLivro->Valor = $livro->Valor;

        $existingLivro->save();

        if ($livro->relationLoaded('autoresCollection')) {
            $this->syncAutores($existingLivro, $livro->autoresCollection);
        }

        if ($livro->relationLoaded('assuntosCollection')) {
            $this->syncAssuntos($existingLivro, $livro->assuntosCollection);
        }
    }

    /**
     * Sync the authors for a given book.
     *
     * @param Livro $livro
     * @param Collection $autores
     */
    private function syncAutores(Livro $livro, Collection $autores): void
    {
        $livro->autores()->sync($autores->all());
    }

    /**
     * Sync the subjects for a given book.
     *
     * @param Livro $livro
     * @param Collection $assuntos
     */
    private function syncAssuntos(Livro $livro, Collection $assuntos): void
    {
        $livro->assuntos()->sync($assuntos->all());
    }
}

<?php

namespace BookRegistry\Livro\Infrastructure\Repository;

use BookRegistry\Livro\Domain\Model\Livro;
use BookRegistry\Livro\Domain\Repository\LivroRepositoryInterface;

class LivroRepository implements LivroRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(Livro $livro): void
    {
        Livro::query()->create([
            'Titulo' => $livro->Titulo,
            'Editora' => $livro->Editora,
            'Edicao' => $livro->Edicao,
            'AnoPublicacao' => $livro->AnoPublicacao,
            'Valor' => $livro->Valor,
        ]);
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
    }

    /**
     * @inheritDoc
     */
    public function findByCodl(int $codl): ?Livro
    {
        return Livro::find($codl);
    }
}

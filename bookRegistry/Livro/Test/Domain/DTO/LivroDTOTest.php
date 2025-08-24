<?php

use BookRegistry\Livro\Domain\DTO\LivroDTO;
use BookRegistry\Livro\Domain\Model\Livro;


it('can be instantiated with livro only', function () {
    $dto = new LivroDTO(
        titulo: 'Test Title',
        editora: 'Test Publisher',
        edicao: 1,
        anoPublicacao: 2020,
        valor: 1000
    );

    expect($dto->titulo)->toBe('Test Title');
    expect($dto->editora)->toBe('Test Publisher');
    expect($dto->edicao)->toBe(1);
    expect($dto->anoPublicacao)->toBe(2020);
    expect($dto->valor)->toBe(1000);
    expect($dto->codl)->toBeNull();
});

it('can be instantiated with codl', function () {
    $dto = new LivroDTO(titulo: 'Test Title', codl: 123);

    expect($dto->titulo)->toBe('Test Title');
    expect($dto->codl)->toBe(123);
});

it('converts to Livro model correctly', function () {
    $dto = new LivroDTO(titulo: 'Test Title', codl: 123);
    $livro = $dto->toLivro();

    expect($livro)->toBeInstanceOf(Livro::class);
    expect($livro->Titulo)->toBe('Test Title');
});

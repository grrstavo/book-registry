<?php

use BookRegistry\Livro\Domain\Model\Livro;


it('can be created with fillable attributes', function () {
    $livro = new Livro(['Titulo' => 'Test Title']);

    expect($livro->Titulo)->toBe('Test Title');
});

it('has correct table name', function () {
    $livro = new Livro();

    expect($livro->getTable())->toBe('Livro');
});

it('has correct primary key', function () {
    $livro = new Livro();

    expect($livro->getKeyName())->toBe('Codl');
});

it('does not use timestamps', function () {
    $livro = new Livro();

    expect($livro->timestamps)->toBeFalse();
});

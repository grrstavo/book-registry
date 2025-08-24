<?php

use BookRegistry\Livro\Domain\Model\Livro;
use BookRegistry\Livro\Domain\Model\LivroFactory;

it('creates Livro instances', function () {
    $factory = new LivroFactory();
    $attributes = $factory->definition();

    expect($attributes)->toHaveKey('Titulo');
    expect($attributes['Titulo'])->toBeString();
    expect($attributes)->toHaveKey('Editora');
    expect($attributes['Editora'])->toBeString();
    expect($attributes)->toHaveKey('Edicao');
    expect($attributes['Edicao'])->toBeInt();
    expect($attributes)->toHaveKey('AnoPublicacao');
    expect($attributes['AnoPublicacao'])->toBeString();
    expect($attributes)->toHaveKey('Valor');
    expect($attributes['Valor'])->toBeInt();
});

it('has correct model class', function () {
    $factory = new LivroFactory();

    expect($factory->modelName())->toBe(Livro::class);
});

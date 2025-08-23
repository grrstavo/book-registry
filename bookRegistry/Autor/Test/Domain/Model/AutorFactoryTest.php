<?php

use BookRegistry\Autor\Domain\Model\Autor;
use BookRegistry\Autor\Domain\Model\AutorFactory;


it('creates Autor instances', function () {
    $factory = new AutorFactory();
    $attributes = $factory->definition();

    expect($attributes)->toHaveKey('Nome');
    expect($attributes['Nome'])->toBeString();
});

it('has correct model class', function () {
    $factory = new AutorFactory();

    expect($factory->modelName())->toBe(Autor::class);
});

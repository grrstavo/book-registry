<?php

use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Domain\Model\AssuntoFactory;


it('creates Assunto instances', function () {
    $factory = new AssuntoFactory();
    $attributes = $factory->definition();

    expect($attributes)->toHaveKey('Descricao');
    expect($attributes['Descricao'])->toBeString();
});

it('has correct model class', function () {
    $factory = new AssuntoFactory();

    expect($factory->modelName())->toBe(Assunto::class);
});

it('generates valid descriptions from predefined list', function () {
    $factory = new AssuntoFactory();
    $validDescriptions = [
        'Ficção', 'Não-ficção', 'Biografia', 'Fantasia', 'Romance',
        'Mistério', 'História', 'Ciência', 'Autoajuda', 'Tecnologia'
    ];

    $attributes = $factory->definition();

    expect($validDescriptions)->toContain($attributes['Descricao']);
});
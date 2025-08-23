<?php

use BookRegistry\Autor\Domain\Model\Autor;

it('can be created with fillable attributes', function () {
    $autor = new Autor(['Nome' => 'Test Name']);

    expect($autor->Nome)->toBe('Test Name');
});

it('has correct table name', function () {
    $autor = new Autor();

    expect($autor->getTable())->toBe('Autor');
});

it('has correct primary key', function () {
    $autor = new Autor();

    expect($autor->getKeyName())->toBe('CodAu');
});

it('does not use timestamps', function () {
    $autor = new Autor();

    expect($autor->timestamps)->toBeFalse();
});

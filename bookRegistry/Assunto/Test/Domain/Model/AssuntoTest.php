<?php

use BookRegistry\Assunto\Domain\Model\Assunto;


it('can be created with fillable attributes', function () {
    $assunto = new Assunto(['Descricao' => 'Test Description']);

    expect($assunto->Descricao)->toBe('Test Description');
});

it('has correct table name', function () {
    $assunto = new Assunto();

    expect($assunto->getTable())->toBe('Assunto');
});

it('has correct primary key', function () {
    $assunto = new Assunto();

    expect($assunto->getKeyName())->toBe('codAs');
});

it('does not use timestamps', function () {
    $assunto = new Assunto();

    expect($assunto->timestamps)->toBeFalse();
});

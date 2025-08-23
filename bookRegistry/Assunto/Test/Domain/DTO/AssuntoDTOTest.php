<?php

use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use BookRegistry\Assunto\Domain\Model\Assunto;


it('can be instantiated with description only', function () {
    $dto = new AssuntoDTO(descricao: 'Test Description');

    expect($dto->descricao)->toBe('Test Description');
    expect($dto->codAs)->toBeNull();
});

it('can be instantiated with description and codAs', function () {
    $dto = new AssuntoDTO(descricao: 'Test Description', codAs: 123);

    expect($dto->descricao)->toBe('Test Description');
    expect($dto->codAs)->toBe(123);
});

it('converts to Assunto model correctly', function () {
    $dto = new AssuntoDTO(descricao: 'Test Description', codAs: 123);
    $assunto = $dto->toAssunto();

    expect($assunto)->toBeInstanceOf(Assunto::class);
    expect($assunto->Descricao)->toBe('Test Description');
});

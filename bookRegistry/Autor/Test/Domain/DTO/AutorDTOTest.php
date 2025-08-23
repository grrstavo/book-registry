<?php

use BookRegistry\Autor\Domain\DTO\AutorDTO;
use BookRegistry\Autor\Domain\Model\Autor;


it('can be instantiated with autor only', function () {
    $dto = new AutorDTO(nome: 'Test Name');

    expect($dto->nome)->toBe('Test Name');
    expect($dto->codAu)->toBeNull();
});

it('can be instantiated with autor and c', function () {
    $dto = new AutorDTO(nome: 'Test Name', codAu: 123);

    expect($dto->nome)->toBe('Test Name');
    expect($dto->codAu)->toBe(123);
});

it('converts to Autor model correctly', function () {
    $dto = new AutorDTO(nome: 'Test Name', codAu: 123);
    $autor = $dto->toAutor();

    expect($autor)->toBeInstanceOf(Autor::class);
    expect($autor->Nome)->toBe('Test Name');
});

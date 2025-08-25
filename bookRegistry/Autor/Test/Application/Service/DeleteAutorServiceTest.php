<?php

use BookRegistry\Autor\Application\Service\DeleteAutorService;
use BookRegistry\Autor\Domain\Repository\AutorRepository;
use BookRegistry\Autor\Domain\Repository\AutorRepositoryInterface;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(AutorRepositoryInterface::class);
    $this->mockRepository = Mockery::mock(AutorRepository::class);
    $this->service = new DeleteAutorService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should delete an autor', function () {
    $codAu = 1;

    $this->mockRepository
        ->shouldReceive('delete')
        ->once()
        ->with($codAu);

    expect(fn() => ($this->service)($codAu))->not->toThrow(DomainException::class);
});

it('should throw an exception if autor not found', function () {
    $codAu = 999;

    $this->mockRepository
        ->shouldReceive('delete')
        ->once()
        ->with($codAu)
        ->andThrow(new DomainException('Autor não encontrado'));

    expect(fn() => ($this->service)($codAu))->toThrow(DomainException::class);
});
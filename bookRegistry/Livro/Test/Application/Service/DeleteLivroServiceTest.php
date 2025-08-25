<?php

use BookRegistry\Livro\Application\Service\DeleteLivroService;
use BookRegistry\Livro\Domain\Repository\LivroRepository;
use BookRegistry\Livro\Domain\Repository\LivroRepositoryInterface;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(LivroRepositoryInterface::class);
    $this->mockRepository = Mockery::mock(LivroRepository::class);
    $this->service = new DeleteLivroService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should delete an Livro', function () {
    $codAs = 1;

    $this->mockRepository
        ->shouldReceive('delete')
        ->once()
        ->with($codAs);

    expect(fn() => ($this->service)($codAs))->not->toThrow(DomainException::class);
});

it('should throw an exception if Livro not found', function () {
    $codAs = 999;

    $this->mockRepository
        ->shouldReceive('delete')
        ->once()
        ->with($codAs)
        ->andThrow(new DomainException('Livro não encontrado'));

    expect(fn() => ($this->service)($codAs))->toThrow(DomainException::class);
});
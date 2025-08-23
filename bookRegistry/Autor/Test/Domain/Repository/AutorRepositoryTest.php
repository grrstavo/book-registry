<?php

use BookRegistry\Autor\Domain\Model\Autor;
use BookRegistry\Autor\Domain\Repository\AutorRepository;
use BookRegistry\Autor\Domain\Repository\AutorRepositoryInterface;
use DomainException;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(AutorRepositoryInterface::class);
    $this->repository = new AutorRepository($this->mockRepositoryInterface);
});

afterEach(function () {
    Mockery::close();
});

it('creates autor successfully when CodAu is not set', function () {
    $autor = new Autor(['Nome' => 'Test Name']);

    $this->mockRepositoryInterface
        ->shouldReceive('create')
        ->once()
        ->with($autor);

    $this->repository->create($autor);
});

it('throws exception when creating autor with existing CodAu', function () {
    $autor = new Autor(['Nome' => 'Test Name']);
    $autor->CodAu = 1;

    expect(fn() => $this->repository->create($autor))
        ->toThrow(DomainException::class, 'O autor não pode ser criado pois já tem código');
});

it('updates autor successfully with valid CodAu', function () {
    $autor = new Autor(['Nome' => 'Updated Name']);
    $codAu = 1;
    $existingAutor = new Autor(['Nome' => 'Existing']);

    $this->mockRepositoryInterface
        ->shouldReceive('findByCodAu')
        ->with($codAu)
        ->once()
        ->andReturn($existingAutor);

    $this->mockRepositoryInterface
        ->shouldReceive('update')
        ->once()
        ->with($autor, $codAu);

    $this->repository->update($autor, $codAu);
});

it('throws exception when updating with invalid CodAu', function () {
    $autor = new Autor(['Nome' => 'Test Name']);

    expect(fn() => $this->repository->update($autor, 0))
        ->toThrow(DomainException::class, 'O autor não pode ser editado pois não tem código');
});

it('throws exception when updating non-existent autor', function () {
    $autor = new Autor(['Nome' => 'Test Name']);
    $codAu = 999;

    $this->mockRepositoryInterface
        ->shouldReceive('findByCodAu')
        ->with($codAu)
        ->once()
        ->andReturn(null);

    expect(fn() => $this->repository->update($autor, $codAu))
        ->toThrow(DomainException::class, 'O autor não pode ser editado pois não existe');
});
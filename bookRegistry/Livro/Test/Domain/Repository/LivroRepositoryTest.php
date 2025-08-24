<?php

use BookRegistry\Livro\Domain\Model\Livro;
use BookRegistry\Livro\Domain\Repository\LivroRepository;
use BookRegistry\Livro\Domain\Repository\LivroRepositoryInterface;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(LivroRepositoryInterface::class);
    $this->repository = new LivroRepository($this->mockRepositoryInterface);
});

afterEach(function () {
    Mockery::close();
});

it('creates livro successfully when Codl is not set', function () {
    $livro = new Livro(['Titulo' => 'Test Title']);

    $this->mockRepositoryInterface
        ->shouldReceive('create')
        ->once()
        ->with($livro);

    $this->repository->create($livro);
});

it('throws exception when creating livro with existing Codl', function () {
    $livro = new Livro(['Titulo' => 'Test Title']);
    $livro->Codl = 1;

    expect(fn() => $this->repository->create($livro))
        ->toThrow(DomainException::class, 'O livro não pode ser criado pois já tem código');
});

it('updates livro successfully with valid Codl', function () {
    $livro = new Livro(['Titulo' => 'Updated Title']);
    $codl = 1;
    $existingLivro = new Livro(['Titulo' => 'Existing']);

    $this->mockRepositoryInterface
        ->shouldReceive('findByCodl')
        ->with($codl)
        ->once()
        ->andReturn($existingLivro);

    $this->mockRepositoryInterface
        ->shouldReceive('update')
        ->once()
        ->with($livro, $codl);

    $this->repository->update($livro, $codl);
});

it('throws exception when updating with invalid Codl', function () {
    $livro = new Livro(['Titulo' => 'Test Title']);

    expect(fn() => $this->repository->update($livro, 0))
        ->toThrow(DomainException::class, 'O livro não pode ser editado pois não tem código');
});

it('throws exception when updating non-existent livro', function () {
    $livro = new Livro(['Titulo' => 'Test Title']);
    $codl = 999;

    $this->mockRepositoryInterface
        ->shouldReceive('findByCodl')
        ->with($codl)
        ->once()
        ->andReturn(null);

    expect(fn() => $this->repository->update($livro, $codl))
        ->toThrow(DomainException::class, 'O livro não pode ser editado pois não existe');
});
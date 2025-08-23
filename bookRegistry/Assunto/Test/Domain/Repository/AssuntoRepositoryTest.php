<?php

use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepository;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepositoryInterface;
use DomainException;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(AssuntoRepositoryInterface::class);
    $this->repository = new AssuntoRepository($this->mockRepositoryInterface);
});

afterEach(function () {
    Mockery::close();
});

it('creates assunto successfully when codAs is not set', function () {
    $assunto = new Assunto(['Descricao' => 'Test Description']);

    $this->mockRepositoryInterface
        ->shouldReceive('create')
        ->once()
        ->with($assunto);

    $this->repository->create($assunto);
});

it('throws exception when creating assunto with existing codAs', function () {
    $assunto = new Assunto(['Descricao' => 'Test Description']);
    $assunto->codAs = 1;

    expect(fn() => $this->repository->create($assunto))
        ->toThrow(DomainException::class, 'O assunto não pode ser criado pois já tem código');
});

it('updates assunto successfully with valid codAs', function () {
    $assunto = new Assunto(['Descricao' => 'Updated Description']);
    $codAs = 1;
    $existingAssunto = new Assunto(['Descricao' => 'Existing']);

    $this->mockRepositoryInterface
        ->shouldReceive('findByCodAs')
        ->with($codAs)
        ->once()
        ->andReturn($existingAssunto);

    $this->mockRepositoryInterface
        ->shouldReceive('update')
        ->once()
        ->with($assunto, $codAs);

    $this->repository->update($assunto, $codAs);
});

it('throws exception when updating with invalid codAs', function () {
    $assunto = new Assunto(['Descricao' => 'Test Description']);

    expect(fn() => $this->repository->update($assunto, 0))
        ->toThrow(DomainException::class, 'O assunto não pode ser editado pois não tem código');
});

it('throws exception when updating non-existent assunto', function () {
    $assunto = new Assunto(['Descricao' => 'Test Description']);
    $codAs = 999;

    $this->mockRepositoryInterface
        ->shouldReceive('findByCodAs')
        ->with($codAs)
        ->once()
        ->andReturn(null);

    expect(fn() => $this->repository->update($assunto, $codAs))
        ->toThrow(DomainException::class, 'O assunto não pode ser editado pois não existe');
});
<?php

use BookRegistry\Assunto\Application\Service\DeleteAssuntoService;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepository;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepositoryInterface;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(AssuntoRepositoryInterface::class);
    $this->mockRepository = Mockery::mock(AssuntoRepository::class);
    $this->service = new DeleteAssuntoService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should delete an Assunto', function () {
    $codAs = 1;

    $this->mockRepository
        ->shouldReceive('delete')
        ->once()
        ->with($codAs);

    expect(fn() => ($this->service)($codAs))->not->toThrow(DomainException::class);
});

it('should throw an exception if Assunto not found', function () {
    $codAs = 999;

    $this->mockRepository
        ->shouldReceive('delete')
        ->once()
        ->with($codAs)
        ->andThrow(new DomainException('Assunto não encontrado'));

    expect(fn() => ($this->service)($codAs))->toThrow(DomainException::class);
});
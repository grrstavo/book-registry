<?php

use BookRegistry\Assunto\Application\Service\CreateAssuntoService;
use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepository;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepositoryInterface;
use DomainException;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(AssuntoRepositoryInterface::class);
    $this->mockRepository = Mockery::mock(AssuntoRepository::class);
    $this->service = new CreateAssuntoService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should create an assunto', function () {
    $dto = new AssuntoDTO(Descricao: 'Descricao do Assunto');

    $this->mockRepository
        ->shouldReceive('create')
        ->once()
        ->with(Mockery::on(function ($assunto) {
            return $assunto instanceof Assunto &&
                   $assunto->Descricao === 'Descricao do Assunto';
        }));

    expect(fn() => ($this->service)($dto))->not->toThrow(DomainException::class);
});

it('should throw exception when Assunto has existing codAs', function () {
    $dto = new AssuntoDTO(codAs: 1, Descricao: 'Test Subject Description');

    $this->mockRepository
        ->shouldReceive('create')
        ->once()
        ->andThrow(new DomainException('O assunto não pode ser criado pois já tem código'));

    expect(fn() => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O assunto não pode ser criado pois já tem código');
});

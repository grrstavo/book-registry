<?php

use BookRegistry\Assunto\Application\Service\UpdateAssuntoService;
use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use BookRegistry\Assunto\Domain\Model\Assunto;
use BookRegistry\Assunto\Domain\Repository\AssuntoRepository;
// use \DomainException;
// use \Exception;

beforeEach(function () {
    $this->mockRepository = Mockery::mock(AssuntoRepository::class);
    $this->service = new UpdateAssuntoService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should successfully update an existing assunto', function () {
    $dto = new AssuntoDTO(descricao: 'Updated Description', codAs: 1);

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($assunto) {
                return $assunto instanceof Assunto &&
                       $assunto->Descricao === 'Updated Description';
            }),
            1
        );

    expect(fn() => ($this->service)($dto))->not->toThrow(Exception::class);
});

it('should throw exception when codAs is zero', function () {
    $dto = new AssuntoDTO(descricao: 'Test Description', codAs: 0);

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($assunto) {
                return $assunto instanceof Assunto &&
                       $assunto->Descricao === 'Test Description';
            }),
            0
        )
        ->andThrow(new DomainException('O assunto não pode ser editado pois não tem código'));

    expect(fn() => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O assunto não pode ser editado pois não tem código');
});

it('should throw exception when assunto does not exist', function () {
    $dto = new AssuntoDTO(descricao: 'Non-existent Description', codAs: 999);

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($assunto) {
                return $assunto instanceof Assunto &&
                       $assunto->Descricao === 'Non-existent Description';
            }),
            999
        )
        ->andThrow(new DomainException('O assunto não pode ser editado pois não existe'));

    expect(fn() => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O assunto não pode ser editado pois não existe');
});

<?php

use BookRegistry\Autor\Application\Service\UpdateAutorService;
use BookRegistry\Autor\Domain\DTO\AutorDTO;
use BookRegistry\Autor\Domain\Model\Autor;
use BookRegistry\Autor\Domain\Repository\AutorRepository;
use DomainException;
use Exception;

beforeEach(function () {
    $this->mockRepository = Mockery::mock(AutorRepository::class);
    $this->service = new UpdateAutorService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should successfully update an existing autor', function () {
    $dto = new AutorDTO(nome: 'Updated Name', codAu: 1);

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($autor) {
                return $autor instanceof Autor &&
                       $autor->Nome === 'Updated Name';
            }),
            1
        );

    expect(fn() => ($this->service)($dto))->not->toThrow(Exception::class);
});

it('should throw exception when CodAu is zero', function () {
    $dto = new AutorDTO(nome: 'Test Name', codAu: 0);

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($autor) {
                return $autor instanceof Autor &&
                       $autor->Nome === 'Test Name';
            }),
            0
        )
        ->andThrow(new DomainException('O autor não pode ser editado pois não tem código'));

    expect(fn() => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O autor não pode ser editado pois não tem código');
});

it('should throw exception when autor does not exist', function () {
    $dto = new AutorDTO(nome: 'Non-existent Name', codAu: 999);

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($autor) {
                return $autor instanceof Autor &&
                       $autor->Nome === 'Non-existent Name';
            }),
            999
        )
        ->andThrow(new DomainException('O autor não pode ser editado pois não existe'));

    expect(fn() => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O autor não pode ser editado pois não existe');
});

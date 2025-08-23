<?php

use BookRegistry\Autor\Application\Service\CreateAutorService;
use BookRegistry\Autor\Domain\DTO\AutorDTO;
use BookRegistry\Autor\Domain\Model\Autor;
use BookRegistry\Autor\Domain\Repository\AutorRepository;
use BookRegistry\Autor\Domain\Repository\AutorRepositoryInterface;
use DomainException;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(AutorRepositoryInterface::class);
    $this->mockRepository = Mockery::mock(AutorRepository::class);
    $this->service = new CreateAutorService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should create an autor', function () {
    $dto = new AutorDTO(nome: 'Nome do Autor');

    $this->mockRepository
        ->shouldReceive('create')
        ->once()
        ->with(Mockery::on(function ($autor) {
            return $autor instanceof Autor &&
                   $autor->Nome === 'Nome do Autor';
        }));

    expect(fn() => ($this->service)($dto))->not->toThrow(DomainException::class);
});

it('should throw exception when Autor has existing CodAu', function () {
    $dto = new AutorDTO(codAu: 1, nome: 'Test Subject Name');

    $this->mockRepository
        ->shouldReceive('create')
        ->once()
        ->andThrow(new DomainException('O autor não pode ser criado pois já tem código'));

    expect(fn() => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O autor não pode ser criado pois já tem código');
});

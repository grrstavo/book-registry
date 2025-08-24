<?php

use BookRegistry\Livro\Application\Service\CreateLivroService;
use BookRegistry\Livro\Domain\DTO\LivroDTO;
use BookRegistry\Livro\Domain\Model\Livro;
use BookRegistry\Livro\Domain\Repository\LivroRepository;
use BookRegistry\Livro\Domain\Repository\LivroRepositoryInterface;
use DomainException;

beforeEach(function () {
    $this->mockRepositoryInterface = Mockery::mock(LivroRepositoryInterface::class);
    $this->mockRepository = Mockery::mock(LivroRepository::class);
    $this->service = new CreateLivroService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should create an livro', function () {
    $dto = new LivroDTO(
        titulo: 'Nome do Livro',
        editora: 'Editora do Livro',
        edicao: '10',
        anoPublicacao: 2020,
        valor: 2990
    );

    $this->mockRepository
        ->shouldReceive('create')
        ->once()
        ->with(Mockery::on(function ($livro) {
            return $livro instanceof Livro &&
                   $livro->Titulo === 'Nome do Livro';
        }));

    expect(fn() => ($this->service)($dto))->not->toThrow(DomainException::class);
});

it('should throw exception when Livro has existing Codl', function () {
    $dto = new LivroDTO(
        titulo: 'Nome do Livro',
        editora: 'Editora do Livro',
        edicao: '10',
        anoPublicacao: 2020,
        valor: 2990,
        codl: 1
    );

    $this->mockRepository
        ->shouldReceive('create')
        ->once()
        ->andThrow(new DomainException('O livro não pode ser criado pois já tem código'));

    expect(fn() => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O livro não pode ser criado pois já tem código');
});

<?php

use BookRegistry\Livro\Application\Service\UpdateLivroService;
use BookRegistry\Livro\Domain\DTO\LivroDTO;
use BookRegistry\Livro\Domain\Model\Livro;
use BookRegistry\Livro\Domain\Repository\LivroRepository;
use DomainException;
use Exception;

beforeEach(function () {
    $this->mockRepository = Mockery::mock(LivroRepository::class);
    $this->service = new UpdateLivroService($this->mockRepository);
});

afterEach(function () {
    Mockery::close();
});

it('should successfully update an existing livro', function () {
    $dto = new LivroDTO(
        titulo: 'Nome do Livro',
        editora: 'Editora do Livro',
        edicao: 10,
        anoPublicacao: 2020,
        valor: 2990,
        codl: 1
    );

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($livro) {
                return $livro instanceof Livro &&
                    $livro->Titulo === 'Nome do Livro' &&
                    $livro->Editora === 'Editora do Livro' &&
                    $livro->Edicao === 10 &&
                    $livro->AnoPublicacao === 2020 &&
                    $livro->Valor === 2990;
            }),
            1
        )
        ->andReturn(true);

    expect(fn () => ($this->service)($dto))->not->toThrow(Exception::class);
});

it('should throw exception when Codl is zero', function () {
    $dto = new LivroDTO(
        titulo: 'Nome do Livro',
        editora: 'Editora do Livro',
        edicao: 10,
        anoPublicacao: 2020,
        valor: 2990,
        codl: 0
    );

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($livro) {
                return $livro instanceof Livro &&
                    $livro->Titulo === 'Nome do Livro' &&
                    $livro->Editora === 'Editora do Livro' &&
                    $livro->Edicao === 10 &&
                    $livro->AnoPublicacao === 2020 &&
                    $livro->Valor === 2990;
            }),
            0
        )
        ->andThrow(new DomainException('O livro não pode ser editado pois não tem código'));

    expect(fn () => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O livro não pode ser editado pois não tem código');
});

it('should throw exception when livro does not exist', function () {
    $dto = new LivroDTO(titulo: 'Non-existent Title', codl: 999);

    $this->mockRepository
        ->shouldReceive('update')
        ->once()
        ->with(
            Mockery::on(function ($livro) {
                return $livro instanceof Livro &&
                       $livro->Titulo === 'Non-existent Title';
            }),
            999
        )
        ->andThrow(new DomainException('O livro não pode ser editado pois não existe'));

    expect(fn () => ($this->service)($dto))
        ->toThrow(DomainException::class, 'O livro não pode ser editado pois não existe');
});

@extends('common.root')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Livros</h1>
        <x-adminlte-button onclick="window.location='{{ route('livros.create') }}'" class="btn-flat text-end" label="Novo" theme="success" icon="fas fa-lg fa-save"/>
    </div>
@stop

@section('content')
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sucesso" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if(session('error'))
        <x-adminlte-alert theme="danger" title="Erro" dismissable>
            {{ session('error') }}
        </x-adminlte-alert>
    @endif

    @php
    $heads = [
        '#',
        'Titulo',
        'Editora',
        'Edição',
        'Ano de Publicação',
        'Valor',
        ['label' => 'Ações', 'width' => 5],
    ];
    @endphp

    <x-adminlte-datatable id="livros" :heads="$heads" striped hoverable with-buttons>
        @foreach($livros as $livro)
            <tr>
                <td>{{ $livro->Codl }}</td>
                <td>{{ $livro->Titulo }}</td>
                <td>{{ $livro->Editora }}</td>
                <td>{{ $livro->Edicao }}</td>
                <td>{{ $livro->AnoPublicacao }}</td>
                <td>{{ Number::currency($livro->getValorToFloat(), in: 'BRL') }}</td>
                <td>
                    <button class="btn btn-xs btn-primary" title="Editar" onclick="window.location='{{ route('livros.edit', $livro->Codl) }}'">
                        <i class="fas fa-lg fa-edit"></i>
                    </button>
                    <form action="{{ route('livros.destroy', $livro->Codl) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-danger" title="Excluir">
                            <i class="fas fa-lg fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {!! $livros->links('pagination::bootstrap-5') !!}

@stop

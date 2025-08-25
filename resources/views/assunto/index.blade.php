@extends('common.root')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Assuntos</h1>
        <x-adminlte-button onclick="window.location='{{ route('assuntos.create') }}'" class="btn-flat text-end" label="Novo" theme="success" icon="fas fa-lg fa-save"/>
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
        'Descrição',
        ['label' => 'Ações', 'width' => 5],
    ];
    @endphp

    <x-adminlte-datatable id="assuntos" :heads="$heads" striped hoverable with-buttons>
        @foreach($assuntos as $assunto)
            <tr>
                <td>{{ $assunto->codAs }}</td>
                <td>{{ $assunto->Descricao }}</td>
                <td>
                    <button class="btn btn-xs btn-primary" title="Editar" onclick="window.location='{{ route('assuntos.edit', $assunto->codAs) }}'">
                        <i class="fas fa-lg fa-edit"></i>
                    </button>
                    <form action="{{ route('assuntos.destroy', $assunto->codAs) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este assunto?');">
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

    {!! $assuntos->links('pagination::bootstrap-5') !!}

@stop

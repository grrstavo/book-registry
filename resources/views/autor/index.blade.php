@extends('common.root')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Autores</h1>
        <x-adminlte-button onclick="window.location='{{ route('autores.create') }}'" class="btn-flat text-end" label="Novo" theme="success" icon="fas fa-lg fa-save"/>
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

    <x-adminlte-datatable id="autores" :heads="$heads" striped hoverable with-buttons>
        @foreach($autores as $autor)
            <tr>
                <td>{{ $autor->CodAu }}</td>
                <td>{{ $autor->Nome }}</td>
                <td>
                    <button class="btn btn-xs btn-primary" title="Editar" onclick="window.location='{{ route('autores.edit', $autor->CodAu) }}'">
                        <i class="fas fa-lg fa-edit"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {!! $autores->links('pagination::bootstrap-5') !!}

@stop

@extends('common.root')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Assuntos</h1>
        <x-adminlte-button onclick="window.location='{{ route('assuntos.create') }}'" class="btn-flat text-end" label="Novo" theme="success" icon="fas fa-lg fa-save"/>
    </div>
@stop

@section('content')
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
                    <button class="btn btn-xs btn-primary" title="Editar" onclick="window.location='{{}}'">
                        <i class="fas fa-lg fa-edit"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {!! $assuntos->links('pagination::bootstrap-5') !!}

    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sucesso" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
@stop

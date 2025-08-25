@extends('common.root')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Autores</h1>
        <div class="d-flex gap-2">
            <form action="{{ route('autores.report') }}" method="POST">
                @csrf
                <x-adminlte-button type="submit" label="Gerar Relatório" theme="primary" class="btn-flat text-end" icon="fas fa-lg fa-list"/>
            </form>

            @if($reportExists)
                <x-adminlte-button onclick="window.location='{{ route('autores.downloadReport') }}'" class="btn-flat text-end" label="Baixar Relatório ({{ date('Y-m-d H:i:s', $lastModified) }})" theme="info" icon="fas fa-lg fa-download"/>
            @endif

            <x-adminlte-button onclick="window.location='{{ route('autores.create') }}'" class="btn-flat text-end" label="Novo" theme="success" icon="fas fa-lg fa-save"/>
        </div>
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

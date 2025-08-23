@extends('common.root')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Alterar Autor #{{ $autor->CodAu }}</h1>
    </div>
@stop

@section('content')
    <form action="{{ route('autores.update', $autor->CodAu) }}" method="POST">
        @csrf
        @method('PUT')
        <x-adminlte-input name="nome" label="Nome" placeholder="Digite o nome" value="{{ $autor->Nome }}"/>
        <x-adminlte-button class="btn-flat" type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
    </form>

    @if(session('error'))
        <br>
        <x-adminlte-alert theme="warning" title="Warning" dismissable>
            {{ session('error') }}
        </x-adminlte-alert>
    @endif
@stop

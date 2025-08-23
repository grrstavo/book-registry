@extends('common.root')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Novo Assunto</h1>
    </div>
@stop

@section('content')
    <form action="{{ route('assuntos.store') }}" method="POST">
        @csrf
        <x-adminlte-input name="descricao" label="Descrição" placeholder="Digite a descrição" value="{{ old('descricao') }}"/>
        <x-adminlte-button class="btn-flat" type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
    </form>

    @if(session('error'))
        <br>
        <x-adminlte-alert theme="warning" title="Warning" dismissable>
            {{ session('error') }}
        </x-adminlte-alert>
    @endif
@stop

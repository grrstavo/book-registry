@extends('common.root')

@section('plugins.Select2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Alterar Livro #{{ $livro->Codl }}</h1>
    </div>
@stop

@section('content')
    @if(session('error'))
        <br>
        <x-adminlte-alert theme="warning" title="Warning" dismissable>
            {{ session('error') }}
        </x-adminlte-alert>
    @endif

    <form action="{{ route('livros.update', $livro->Codl) }}" method="POST">
        @csrf
        @method('PUT')
        <x-adminlte-input name="titulo" label="Título" placeholder="Digite o título" value="{{ $livro->Titulo }}"/>
        <x-adminlte-input name="editora" label="Editora" placeholder="Digite a editora" value="{{ $livro->Editora }}"/>
        <x-adminlte-input name="edicao" label="Edição" placeholder="Digite o numero da edição" value="{{ $livro->Edicao }}"/>
        <x-adminlte-input name="anoPublicacao" label="Ano de Publicação" placeholder="Digite o ano de publicação" value="{{ $livro->AnoPublicacao }}"/>
        <x-adminlte-input name="valor" label="Valor" placeholder="Digite o valor" value="{{ $livro->getValorToFloat() }}" id="valor"/>

        <x-adminlte-select2 id="assuntos" name="assuntos[]" label="Assuntos" multiple>
            @foreach($assuntos as $assunto)
                <option {{ in_array($assunto->codAs, old('assuntos', $livro->assuntos->pluck('codAs')->all())) ? 'selected' : '' }} value="{{ $assunto->codAs }}">
                    {{ $assunto->Descricao }}
                </option>
            @endforeach
        </x-adminlte-select2>
        
        <x-adminlte-select2 id="autores" name="autores[]" label="Autores" multiple>
            @foreach($autores as $autor)
                <option {{ in_array($autor->CodAu, old('autores', $livro->autores->pluck('CodAu')->all())) ? 'selected' : '' }} value="{{ $autor->CodAu }}">
                    {{ $autor->Nome }}
                </option>
            @endforeach
        </x-adminlte-select2>

        <x-adminlte-button class="btn-flat" type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
@stop

@section('js')
<script>
$(document).ready(function() {
    const $valorInput = $('#valor');

    // Set initial value to "0.00"
    if (!$valorInput.val()) {
        $valorInput.val('0.00');
    }

    $valorInput.on('input', function() {
        let value = $(this).val();

        // Remove all non-numeric characters except dots
        value = value.replace(/[^\d]/g, '');

        // If empty, set to "000"
        if (value === '') {
            value = '000';
        }

        // Pad with zeros to ensure at least 3 digits
        value = value.padStart(3, '0');

        // Insert decimal point before last 2 digits
        const integerPart = value.slice(0, -2);
        const decimalPart = value.slice(-2);

        // Remove leading zeros from integer part but keep at least one digit
        const cleanIntegerPart = integerPart.replace(/^0+/, '') || '0';

        const formattedValue = cleanIntegerPart + '.' + decimalPart;

        $(this).val(formattedValue);
    });
    
    $valorInput.on('focus', function() {
        // If the value is "0.00", select all for easy replacement
        if ($(this).val() === '0.00') {
            $(this).select();
        }
    });
    
    $valorInput.on('blur', function() {
        // If empty on blur, set back to "0.00"
        if ($(this).val() === '' || $(this).val() === '.') {
            $(this).val('0.00');
        }
    });
});
</script>
@endsection
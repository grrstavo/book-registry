<?php

namespace BookRegistry\Livro\Http\Request;

use BookRegistry\Livro\Domain\DTO\LivroDTO;
use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:40',
            'editora' => 'required|string|max:40',
            'edicao' => 'required|integer',
            'anoPublicacao' => 'required|integer|min:1000|max:' . date('Y'),
            'valor' => 'required|numeric|min:0'
        ];
    }

    /**
     * Get the custom validation messages for the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo Título é obrigatório.',
            'titulo.string' => 'O campo Título deve ser uma string.',
            'titulo.max' => 'O campo Título não pode exceder 40 caracteres.',
            'editora.required' => 'O campo Editora é obrigatório.',
            'editora.string' => 'O campo Editora deve ser uma string.',
            'editora.max' => 'O campo Editora não pode exceder 40 caracteres.',
            'edicao.required' => 'O campo Edição é obrigatório.',
            'edicao.integer' => 'O campo Edição deve ser um número inteiro.',
            'anoPublicacao.required' => 'O campo Ano de Publicação é obrigatório.',
            'anoPublicacao.integer' => 'O campo Ano de Publicação deve ser um número inteiro.',
            'anoPublicacao.min' => 'O campo Ano de Publicação deve ser no mínimo 1000.',
            'anoPublicacao.max' => 'O campo Ano de Publicação não pode ser maior que o ano atual.',
            'valor.required' => 'O campo Valor é obrigatório.',
            'valor.numeric' => 'O campo Valor deve ser um número.',
            'valor.min' => 'O campo Valor não pode ser negativo.'
        ];
    }

    /**
     * Transform the request into a Data Transfer Object (DTO).
     *
     * @return LivroDTO
     */
    public function toDTO(): LivroDTO
    {
        return new LivroDTO(
            titulo: $this->input('titulo'),
            editora: $this->input('editora'),
            edicao: $this->input('edicao'),
            anoPublicacao: $this->input('anoPublicacao'),
            valor: str_replace(".", "", $this->input('valor')),
            codl: $this->route('codl'),
        );
    }
}

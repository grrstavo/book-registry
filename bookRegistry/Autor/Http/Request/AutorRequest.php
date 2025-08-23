<?php

namespace BookRegistry\Autor\Http\Request;

use BookRegistry\Autor\Domain\DTO\AutorDTO;
use Illuminate\Foundation\Http\FormRequest;

class AutorRequest extends FormRequest
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
            'nome' => 'required|string|max:40',
            'CodAu' => 'integer|exists:autores,CodAu'
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
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser uma string',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'CodAu.integer' => 'O campo código deve ser um número inteiro',
            'CodAu.exists' => 'O autor com o código informado não existe'
        ];
    }

    /**
     * Transform the request into a Data Transfer Object (DTO).
     *
     * @return AutorDTO
     */
    public function toDTO(): AutorDTO
    {
        return new AutorDTO(
            codAu: $this->route('codAu'),
            nome: $this->input('nome')
        );
    }
}

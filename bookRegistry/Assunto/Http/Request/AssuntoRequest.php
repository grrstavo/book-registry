<?php

namespace BookRegistry\Assunto\Http\Request;

use BookRegistry\Assunto\Domain\DTO\AssuntoDTO;
use Illuminate\Foundation\Http\FormRequest;

class AssuntoRequest extends FormRequest
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
            'descricao' => 'required|string|max:40',
            'codAs' => 'integer|exists:assuntos,codAs'
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
            'descricao.required' => 'O campo descrição é obrigatório',
            'descricao.string' => 'O campo descrição deve ser uma string',
            'descricao.max' => 'O campo descrição deve ter no máximo 40 caracteres',
            'codAs.integer' => 'O campo código deve ser um número inteiro',
            'codAs.exists' => 'O assunto com o código informado não existe'
        ];
    }

    /**
     * Transform the request into a Data Transfer Object (DTO).
     *
     * @return AssuntoDTO
     */
    public function toDTO(): AssuntoDTO
    {
        return new AssuntoDTO(
            codAs: $this->route('codAs'),
            descricao: $this->input('descricao')
        );
    }
}

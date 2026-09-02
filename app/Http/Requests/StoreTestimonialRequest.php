<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'autor' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'evento_tipo' => ['required', 'string', 'exists:event_types,nome'],
            'nota' => ['required', 'integer', 'min:1', 'max:5'],
            'texto' => ['required', 'string', 'min:15', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'autor.required' => 'Informe o seu nome.',
            'autor.min' => 'O nome precisa ter pelo menos 3 letras.',
            'autor.regex' => 'Informe o nome sem números ou símbolos.',
            'evento_tipo.required' => 'Selecione o tipo de evento.',
            'evento_tipo.exists' => 'O tipo de evento selecionado é inválido.',
            'nota.required' => 'Selecione uma avaliação de 1 a 5 estrelas.',
            'nota.min' => 'Selecione uma avaliação de 1 a 5 estrelas.',
            'nota.max' => 'Selecione uma avaliação de 1 a 5 estrelas.',
            'texto.required' => 'Conte como foi a sua experiência.',
            'texto.min' => 'Conte um pouco mais (mínimo 15 caracteres).',
        ];
    }
}

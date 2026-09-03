<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuoteRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{L}\s]+$/u', 'regex:/^\S+\s+\S+/'],
            'telefone' => ['required', 'string', 'regex:/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/'],
            'data_evento' => [
                'required',
                'date',
                'after_or_equal:' . now()->addDays(3)->format('Y-m-d'),
                'before:' . now()->addYears(5)->format('Y-m-d'),
            ],
            'numero_convidados' => ['required', 'integer', 'min:40', 'max:200'],
            'event_type_id' => ['required', 'exists:event_types,id'],
            'mensagem' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Informe o seu nome.',
            'nome.min' => 'O nome precisa ter pelo menos 3 letras.',
            'nome.regex' => 'Informe o nome completo, sem números ou símbolos.',
            'telefone.required' => 'Informe um telefone para contato.',
            'telefone.regex' => 'Informe um telefone válido, com DDD. Ex: (43) 90000-0000.',
            'data_evento.required' => 'Informe a data do evento.',
            'data_evento.after_or_equal' => 'Solicite com pelo menos 3 dias de antecedência.',
            'data_evento.before' => 'A data do evento deve ser em até 5 anos.',
            'numero_convidados.required' => 'Informe o número de convidados.',
            'numero_convidados.integer' => 'Informe um número de convidados válido.',
            'numero_convidados.min' => 'Para grupos menores que 40 pessoas, fale diretamente com nossa equipe pelo WhatsApp.',
            'numero_convidados.max' => 'O espaço comporta até 200 convidados. Para grupos maiores, fale diretamente com nossa equipe.',
            'event_type_id.required' => 'Selecione o tipo de evento.',
            'event_type_id.exists' => 'O tipo de evento selecionado é inválido.',
        ];
    }
}
<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\QuoteRequest;

class QuoteRequestService
{
    public function __construct(private WhatsAppNotifier $whatsapp)
    {
    }

    public function handle(array $data): QuoteRequest
    {
        $lead = Lead::create([
        'nome' => $data['nome'],
        'telefone' => $data['telefone'],
        'email' => $data['email'] ?? null,
        'data_evento' => $data['data_evento'] ?? null,
        'numero_convidados' => $data['numero_convidados'] ?? null,
        'event_type_id' => $data['event_type_id'],
        'status' => 'novo',
        ]);

        $quoteRequest = QuoteRequest::create([
            'lead_id' => $lead->id,
            'mensagem' => $data['mensagem'] ?? null,
            'status_validacao' => 'pendente',
        ]);

        $this->notificarAdministrador($lead, $quoteRequest);

        return $quoteRequest;
    }

    private function notificarAdministrador(Lead $lead, QuoteRequest $quoteRequest): void
    {
        $data = $lead->data_evento ? \Carbon\Carbon::parse($lead->data_evento)->format('d/m/Y') : 'não informada';

        $mensagem = "🎉 *Novo pedido de orçamento — Juari Eventos*\n\n"
            . "*Nome:* {$lead->nome}\n"
            . "*Telefone:* {$lead->telefone}\n"
            . "*E-mail:* " . ($lead->email ?: 'não informado') . "\n"
            . "*Tipo de evento:* " . ($lead->eventType?->nome ?? 'não informado') . "\n"
            . "*Data desejada:* {$data}\n"
            . "*Convidados:* " . ($lead->numero_convidados ?? 'não informado') . "\n\n"
            . "*Mensagem do cliente:*\n"
            . ($quoteRequest->mensagem ?: 'nenhuma observação');

        // E-mail continua como canal de apoio (Sprint 3); o WhatsApp é o principal.
        // Sem credenciais configuradas, o WhatsAppNotifier registra em log e segue normalmente.
        $this->whatsapp->send($mensagem);
    }
}
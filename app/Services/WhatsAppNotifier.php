<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppNotifier
{
    public function send(string $mensagem): bool
    {
        $token = config('services.whatsapp.token');
        $phoneNumberId = config('services.whatsapp.phone_number_id');
        $to = config('services.whatsapp.notify_to');

        if (! $token || ! $phoneNumberId || ! $to) {
            Log::info('[WhatsApp] Credenciais não configuradas — mensagem não enviada.', [
                'mensagem' => $mensagem,
            ]);

            return false;
        }

        $response = Http::withToken($token)
            ->post("https://graph.facebook.com/v20.0/{$phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $to,
                'type' => 'text',
                'text' => ['body' => $mensagem],
            ]);

        if ($response->failed()) {
            Log::error('[WhatsApp] Falha ao enviar notificação.', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        }

        return true;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequestRequest;
use App\Models\EventType;
use App\Services\QuoteRequestService;
use Illuminate\Http\RedirectResponse;

class QuoteRequestController extends Controller
{
    public function store(StoreQuoteRequestRequest $request, QuoteRequestService $service): RedirectResponse
    {
        $dados = $request->validated();
        $service->handle($dados);

        $tipoEvento = EventType::find($dados['event_type_id']);

        return redirect('/#orcamento')
            ->with('sucesso', 'Nossa equipe entrará em contato em breve para dar continuidade ao seu evento.')
            ->with('resumo', [
                'nome' => $dados['nome'],
                'evento' => $tipoEvento?->nome ?? 'Não informado',
                'data' => $dados['data_evento'] ?? null,
            ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;

class TestimonialController extends Controller
{
    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $dados = $request->validated();

        Testimonial::create([
            'autor' => $dados['autor'],
            'texto' => $dados['texto'],
            'evento_tipo' => $dados['evento_tipo'],
            'nota' => $dados['nota'],
            'publicado' => false,
        ]);

        return redirect('/#depoimentos')
            ->with('depoimento_sucesso', 'Obrigado pelo depoimento! Assim que for revisado, ele passa a aparecer aqui na página.');
    }
}

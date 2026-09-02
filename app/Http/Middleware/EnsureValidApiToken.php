<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureValidApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = config('services.gerenciador.api_token');
        $enviado = $request->bearerToken();

        if (! $token || ! $enviado || ! hash_equals($token, $enviado)) {
            abort(401, 'Token de API inválido ou ausente.');
        }

        return $next($request);
    }
}

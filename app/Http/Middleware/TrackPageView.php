<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    public function handle(Request $request, Closure $next, string $pagina): Response
    {
        $response = $next($request);

        if ($response->isSuccessful()) {
            PageView::create(['pagina' => $pagina]);
        }

        return $response;
    }
}

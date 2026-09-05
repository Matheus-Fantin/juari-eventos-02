<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PageView;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class PageViewController extends Controller
{
    public function index(): JsonResponse
    {
        $agora = Carbon::now();
        $inicioHoje = $agora->copy()->startOfDay();
        $inicioSemana = $agora->copy()->startOfWeek();
        $inicioMes = $agora->copy()->startOfMonth();

        $porPagina = collect(PageView::PAGINAS)->map(function (string $label, string $slug) {
            return [
                'pagina' => $slug,
                'label' => $label,
                'total' => PageView::where('pagina', $slug)->count(),
            ];
        })->values();

        $ultimos30Dias = PageView::where('created_at', '>=', $agora->copy()->subDays(29)->startOfDay())
            ->selectRaw('DATE(created_at) as dia, COUNT(*) as total')
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        return response()->json(['data' => [
            'total' => PageView::count(),
            'hoje' => PageView::where('created_at', '>=', $inicioHoje)->count(),
            'semana' => PageView::where('created_at', '>=', $inicioSemana)->count(),
            'mes' => PageView::where('created_at', '>=', $inicioMes)->count(),
            'por_pagina' => $porPagina,
            'ultimos_30_dias' => $ultimos30Dias,
        ]]);
    }
}

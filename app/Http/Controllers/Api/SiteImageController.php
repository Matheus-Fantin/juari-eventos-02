<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteImageController extends Controller
{
    public function index(): JsonResponse
    {
        $existentes = SiteImage::all()->keyBy('slot');

        $data = collect(SiteImage::SLOTS)->map(function (array $info, string $slot) use ($existentes) {
            $image = $existentes->get($slot);

            return [
                'slot' => $slot,
                'label' => $info['label'],
                'url' => $image ? $image->url() : SiteImage::urlFor($slot),
                'definida' => (bool) ($image?->caminho_arquivo),
                'proporcao' => $info['proporcao'],
                'dica' => $info['dica'],
            ];
        })->values();

        return response()->json(['data' => $data]);
    }

    public function update(Request $request, string $slot): JsonResponse
    {
        if (! array_key_exists($slot, SiteImage::SLOTS)) {
            abort(404, 'Local de imagem desconhecido.');
        }

        $request->validate([
            'imagem' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ], [
            'imagem.required' => 'Escolha uma imagem para enviar.',
            'imagem.image' => 'O arquivo precisa ser uma imagem (jpg, png, webp...).',
            'imagem.mimes' => 'Formato não aceito. Envie jpg, png ou webp.',
            'imagem.max' => 'A imagem não pode passar de 8MB.',
        ]);

        $image = SiteImage::firstOrNew(['slot' => $slot]);
        $antigo = $image->caminho_arquivo;

        $image->caminho_arquivo = $request->file('imagem')->store('site', 'public');
        $image->save();

        if ($antigo) {
            Storage::disk('public')->delete($antigo);
        }

        return response()->json(['data' => [
            'slot' => $image->slot,
            'url' => $image->url(),
        ]]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(): JsonResponse
    {
        $galleries = Gallery::with(['photos' => fn ($q) => $q->orderBy('ordem')])->orderBy('id')->get();

        $data = $galleries->map(fn (Gallery $gallery) => [
            'id' => $gallery->id,
            'nome' => $gallery->nome,
            'categoria' => $gallery->categoria,
            'tipo' => $gallery->tipo,
            'photos' => $gallery->photos->map(fn (Photo $photo) => [
                'id' => $photo->id,
                'url' => $photo->url(),
                'ordem' => $photo->ordem,
                'publicada' => $photo->publicada,
            ]),
        ]);

        return response()->json(['data' => $data]);
    }

    public function storePhoto(Request $request, Gallery $gallery): JsonResponse
    {
        $data = $request->validate([
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ], [
            'foto.required' => 'Escolha uma imagem para enviar.',
            'foto.image' => 'O arquivo precisa ser uma imagem (jpg, png, webp...).',
            'foto.mimes' => 'Formato não aceito. Envie jpg, png ou webp.',
            'foto.max' => 'A imagem não pode passar de 8MB.',
        ]);

        $caminho = $request->file('foto')->store('galeria/'.$gallery->categoria, 'public');

        $photo = Photo::create([
            'gallery_id' => $gallery->id,
            'caminho_arquivo' => $caminho,
            'ordem' => $gallery->photos()->max('ordem') + 1,
            'publicada' => true,
        ]);

        return response()->json(['data' => $photo], 201);
    }

    public function destroyPhoto(Photo $photo): JsonResponse
    {
        Storage::disk('public')->delete($photo->caminho_arquivo);
        $photo->delete();

        return response()->json(['message' => 'Foto excluída.']);
    }
}

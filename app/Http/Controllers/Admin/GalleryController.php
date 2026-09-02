<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::with(['photos' => fn ($q) => $q->orderBy('ordem')])->orderBy('id')->get();
        $grupos = [
            'eventos' => ['titulo' => 'Tipos de Evento', 'galerias' => $galleries->where('tipo', 'eventos')],
            'gastronomia' => ['titulo' => 'Gastronomia', 'galerias' => $galleries->where('tipo', 'gastronomia')],
        ];

        return view('admin.galleries.index', ['grupos' => $grupos]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'gallery_id' => ['required', 'exists:galleries,id'],
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ], [
            'foto.required' => 'Escolha uma imagem para enviar.',
            'foto.image' => 'O arquivo precisa ser uma imagem (jpg, png, webp...).',
            'foto.mimes' => 'Formato não aceito. Envie jpg, png ou webp.',
            'foto.max' => 'A imagem não pode passar de 8MB.',
        ]);

        $gallery = Gallery::findOrFail($data['gallery_id']);
        $caminho = $request->file('foto')->store('galeria/' . $gallery->categoria, 'public');

        Photo::create([
            'gallery_id' => $gallery->id,
            'caminho_arquivo' => $caminho,
            'ordem' => $gallery->photos()->max('ordem') + 1,
            'publicada' => true,
        ]);

        return back()->with('status', 'Foto adicionada em "' . $gallery->nome . '".');
    }

    public function destroy(Photo $photo): RedirectResponse
    {
        Storage::disk('public')->delete($photo->caminho_arquivo);
        $photo->delete();

        return back()->with('status', 'Foto excluída.');
    }
}

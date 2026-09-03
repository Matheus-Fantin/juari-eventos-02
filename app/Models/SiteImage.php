<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteImage extends Model
{
    protected $fillable = ['slot', 'caminho_arquivo'];

    /**
     * Slots conhecidos: chave => [rótulo para o painel, imagem padrão (fallback) em public/,
     * proporção real usada no site (pra o painel mostrar uma prévia fiel) e uma dica de tamanho].
     */
    public const SLOTS = [
        'home_capa' => [
            'label' => 'Capa da tela inicial',
            'padrao' => 'images/home/home-1.jpg',
            'proporcao' => '21:9',
            'dica' => 'Foto bem larga e horizontal (ex: 1920×820px). Evite fotos verticais ou com o assunto principal nas bordas — elas ficam cortadas.',
        ],
        'galeria_capa' => [
            'label' => 'Capa da galeria',
            'padrao' => 'images/galeria/capa.jpg',
            'proporcao' => '21:9',
            'dica' => 'Foto bem larga e horizontal (ex: 1920×820px). Evite fotos verticais ou com o assunto principal nas bordas — elas ficam cortadas.',
        ],
        'sobre_capa' => [
            'label' => 'Capa da página Sobre',
            'padrao' => 'images/sobre/capa.jpg',
            'proporcao' => '21:9',
            'dica' => 'Foto bem larga e horizontal (ex: 1920×820px). Evite fotos verticais ou com o assunto principal nas bordas — elas ficam cortadas.',
        ],
        'sobre_bloco_1' => [
            'label' => 'Sobre — foto 1',
            'padrao' => 'images/sobre/sobre-1.jpg',
            'proporcao' => '16:9',
            'dica' => 'Foto horizontal (ex: 1200×675px), com o assunto principal centralizado.',
        ],
        'sobre_bloco_2' => [
            'label' => 'Sobre — foto 2',
            'padrao' => 'images/sobre/sobre-2.jpg',
            'proporcao' => '16:9',
            'dica' => 'Foto horizontal (ex: 1200×675px), com o assunto principal centralizado.',
        ],
    ];

    /**
     * URL da imagem enviada pelo painel, se houver; senão a imagem padrão do repositório, se existir; senão null.
     */
    public function url(): ?string
    {
        if ($this->caminho_arquivo) {
            return Storage::disk('public')->url($this->caminho_arquivo);
        }

        $padrao = self::SLOTS[$this->slot]['padrao'] ?? null;

        if ($padrao && file_exists(public_path($padrao))) {
            return asset($padrao);
        }

        return null;
    }

    public static function urlFor(string $slot): ?string
    {
        $image = static::firstWhere('slot', $slot);

        if ($image) {
            return $image->url();
        }

        $padrao = self::SLOTS[$slot]['padrao'] ?? null;

        return ($padrao && file_exists(public_path($padrao))) ? asset($padrao) : null;
    }
}

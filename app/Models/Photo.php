<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['gallery_id', 'caminho_arquivo', 'legenda', 'ordem', 'publicada'];

    protected $casts = [
        'publicada' => 'boolean',
    ];

    public function url(): string
    {
        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->caminho_arquivo);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
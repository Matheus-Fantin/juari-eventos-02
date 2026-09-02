<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['gallery_id', 'caminho_arquivo', 'ordem', 'publicada'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
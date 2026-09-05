<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['pagina'];

    public const PAGINAS = [
        'home' => 'Início',
        'sobre' => 'Sobre',
        'galeria' => 'Galeria',
    ];
}

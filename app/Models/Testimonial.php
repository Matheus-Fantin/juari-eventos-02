<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['autor', 'texto', 'evento_tipo', 'nota', 'publicado'];

    protected $casts = [
        'publicado' => 'boolean',
        'nota' => 'integer',
    ];
}
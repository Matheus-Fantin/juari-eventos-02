<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['nome', 'categoria', 'tipo'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
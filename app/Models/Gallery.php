<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['nome', 'categoria'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
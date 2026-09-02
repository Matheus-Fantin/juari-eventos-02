<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = ['nome', 'descricao'];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
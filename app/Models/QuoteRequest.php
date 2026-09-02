<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = ['lead_id', 'mensagem', 'status_validacao'];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
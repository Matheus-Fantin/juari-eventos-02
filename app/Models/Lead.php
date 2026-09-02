<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
    'nome', 'telefone', 'email', 'data_evento', 'numero_convidados',
    'event_type_id', 'user_id', 'status', 'observacoes',
    ];
    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quoteRequests()
    {
        return $this->hasMany(QuoteRequest::class);
    }
}
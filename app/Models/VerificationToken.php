<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationToken extends BaseModel
{
    protected $fillable = [
        'client_id',
        'token',
        'type',// Pode ser 'email' ou 'cellphone'
        'expires_at',
    ];

    protected $dates = [
        'expires_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

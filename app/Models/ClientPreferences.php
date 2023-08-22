<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPreferences extends Model
{
    // Campos do modelo

    protected $fillable = [
        'clientId',
        'notificationPreferences',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

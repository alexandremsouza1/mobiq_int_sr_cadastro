<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPreferences extends BaseModel
{
    // Campos do modelo

    protected $table = 'client_preferences';

    protected $fillable = [
        'clientId',
        'notificationPreferences',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientPreferences extends Model
{
    // Campos do modelo

    protected $fillable = [
        'notification_preferences',
    ];
}

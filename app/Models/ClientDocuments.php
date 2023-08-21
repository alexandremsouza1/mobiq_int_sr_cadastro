<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDocuments extends Model
{
    // Campos do modelo

    protected $fillable = [
        'cnpj',
        'photo_address',
        'photo_document',
        'photo_establishment_facade',
        'interior_establishment_photo'
    ];
}

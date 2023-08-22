<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDocuments extends Model
{
    // Campos do modelo

    protected $fillable = [
        'clientId',
        'identification', 
        'addressProof',
        'storeFront',
        'storeInterior'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

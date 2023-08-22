<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnersDocuments extends BaseModel
{
    protected $table = 'partners_documents';

    protected $fillable = [
        'partnerId',
        'identification', 
        'addressProof',
        'storeFront',
        'storeInterior'
    ];

    public function cliente()
    {
        return $this->belongsTo(Partner::class);
    }
}

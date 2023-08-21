<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
  // Campos do modelo
  protected $fillable = [
    'company_state',
    'company_city',
    'company_address',
    'company_address_complement',
    'company_address_number',
    'company_cep',
    'company_neighborhood',
    'latitude',
    'longitude' 
  ];
}

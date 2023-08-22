<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
  // Campos do modelo
  protected $fillable = [
    'companyId',
    'postalCode',
    'street',
    'streetNumber',
    'complement',
    'reference',
    'neighborhood',
    'city',
    'state',
  ];


  public function company()
  {
      return $this->belongsTo(Company::class);
  }
}

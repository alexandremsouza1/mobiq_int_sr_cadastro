<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  // Campos do modelo
  protected $fillable = [
    'cpf_cnpj',
    'company_social_name',
    'company_fantasy_name',
    'ec_number',
    'merchant_id',
  ];

  // Relações do modelo
  public function address()
  {
    return $this->hasOne(CompanyAddress::class);
  }
}

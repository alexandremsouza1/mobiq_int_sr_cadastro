<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends BaseModel
{

  protected $table = 'companies';
  // Campos do modelo
  protected $fillable = [
    'id',
    'responsibleId',
    'cpfCnpj',
    'socialName',
    'fantasyName',
    'address',
    'businessKey',
    'ecNumber',
    'merchantId',
    'latitude',
    'longitude',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  // Relações do modelo
  public function address()
  {
    return $this->hasOne(Adresses::class);
  }

  public function responsible()
  {
      return $this->belongsTo(Responsible::class);
  }
}

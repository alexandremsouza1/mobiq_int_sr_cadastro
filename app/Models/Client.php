<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $fillable = [
    'id',
    'document', //CNPJ ou CPF
    'password', // password_hash('sua senha aqui', 1)
    'clientId', 
    'businessCategory', //Desc_Canal
    'name',
    'sector', //ConsultarSetores
    'status', // active , blocked , review ,  dbClient , noRegister ,  confirmation,  company ,  logistic,  partner ,  documents
    'category' // 1 - 5
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  // Relações do modelo
  public function documents()
  {
    return $this->hasMany(ClientDocuments::class);
  }

  public function authentication()
  {
    return $this->hasOne(ClientAuthentication::class);
  }
}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Client extends BaseModel
{
  protected $table = 'clients';

  protected $fillable = [
    'id',
    'document', //CNPJ ou CPF
    'password', // password_hash('sua senha aqui', 1)
    'clientId',
    'businessCategory', //Desc_Canal
    'name',
    'sector', //ConsultarSetores
    'status',
    'category' // 1 - 5
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  const TYPES_STATUS =[
    'dbClient',
    'noRegister', 
    'confirmation', 
    'review', 
    'blocked', 
    'canceled', 
    'contact', 
    'company', 
    'logistic', 
    'documents', 
    'reanalysis', 
    'active'
  ];


  public function rules()
  {
    return [
      'document' => 'required|string|max:255',
      'name' => 'required|string|max:255',
      'sector' => 'required|string|max:255',
      'status' => ['required', Rule::in(self::TYPES_STATUS)],
    ];
  }

  // Relações do modelo
  public function documents()
  {
    return $this->hasMany(ClientDocuments::class);
  }

  public function authentication()
  {
    return $this->hasOne(ClientAuthentication::class);
  }

  //client_situations
  public function clientSituation()
  {
    return $this->hasOne(ClientSituation::class);
  }
}

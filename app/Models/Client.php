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

//   //
// | 0-  Tem cadastro na base = dbClient
// | 1-  Sem registro  = noRegister
// | 2 - Ativação SMS Pendente  = confirmation
// | 3 - Cadastro em Análise  = review
// | 4 - Cadastro Bloqueado =  blocked
// | 5 - Cadastro Cancelado = canceled
// | 6 - Cadastro na etapa do Contato = contact
// | 7 - Cadastro na etapa da Empresa = company
// | 8 - Cadastro na etapa da Logistica = logistic
// | 9 - Cadastro na Etapa de Envio de Documento = documents
// | 10 - Cadastro dentro do prazo para reanalise = reanalysis
// | 11 - Ativo  = active

  protected $rules = [
    'status' => Rule::in(
      ['noRegister', 
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
    ]),
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

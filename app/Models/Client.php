<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $fillable = [
    'id',
    'client_id',
    'client_type_id',
    'name',
    'sector',
    'agent_id',
    'type_consumer',
    'activated',
    'id_rede',
    'type',
    'category',
    'pdv_code',
    'sector',
    'type_consumer',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  // Relações do modelo
  public function documents()
  {
    return $this->hasOne(ClientDocuments::class);
  }

  public function authentication()
  {
    return $this->hasOne(ClientAuthentication::class);
  }
}

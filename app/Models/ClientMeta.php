<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientMeta extends BaseModel
{

  protected $table = 'client_meta';
  // Campos do modelo

  protected $fillable = [
    // 'clientId',
    // 'reset_password_token',
    // 'reset_password_token_expiration',
    // 'activation_code',
    // 'push_token',
    // 'remember',
    // 'last_login_at'
    'id',
    'clientId',
    'key',
    'value',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

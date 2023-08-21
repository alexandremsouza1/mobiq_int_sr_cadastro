<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientAuthentication extends Model
{
  // Campos do modelo

  protected $fillable = [
    'reset_password_token',
    'reset_password_token_expiration',
    'activation_code',
    'push_token',
    'remember',
    'last_login_at'
  ];
}

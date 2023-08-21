<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Responsible extends Model {
  // Campos do modelo

  protected $fillable = [
    'responsible_name',
    'responsible_email',
    'responsible_password',
    'responsible_password_temp',
    'responsible_password_temp_expire_at',
    'responsible_phone',
    'responsible_birthday',
    'responsible_address'
  ];

  // Relações do modelo
  public function address() {
      return $this->hasOne(ResponsibleAddress::class);
  }

}



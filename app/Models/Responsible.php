<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Responsible extends Model {
  // Campos do modelo

  protected $fillable = [
    'id',
    'name',
    'address',
    'birthday',
    'email',
    'password',
    'cellphone',
    'comercialPhone',
    'residencialPhone',
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  protected $rules = [
    'name' => 'required',
    'address' => 'required',
    'birthday' => 'date',
  ];

  // Relações do modelo
  public function address() {
      return $this->hasOne(ResponsibleAddress::class);
  }

}



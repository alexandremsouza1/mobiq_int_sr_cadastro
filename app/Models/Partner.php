<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Partner extends Model
{
  // Campos do modelo
  protected $fillable = [
    'id',
    'companyId',
    'firstName',
    'lastName',
    'cpf',
    'birthday'
  ];

  protected $rules = [
    'companyId' => 'required',
    'firstName' => 'required',
    'lastName' => 'required',
    'cpf' => 'required',
    'birthday' => 'date'
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  public function company()
  {
      return $this->belongsTo(Company::class);
  }
}

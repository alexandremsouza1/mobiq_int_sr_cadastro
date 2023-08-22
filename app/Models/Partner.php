<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Partner extends BaseModel
{
  protected $table = 'partners';
  // Campos do modelo
  protected $fillable = [
    'id',
    'companyId',
    'firstName',
    'lastName',
    'cpf',
    'birthday'
  ];

  public function rules()
  {
    return [
      'firstName' => 'required',
      'lastName' => 'required',
      'cpf' => 'required',
      'birthday' => 'date_format:Y-m-d\TH:i:s.u\Z'
    ];
  }

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

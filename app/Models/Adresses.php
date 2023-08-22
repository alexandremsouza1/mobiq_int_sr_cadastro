<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Adresses extends BaseModel
{
  // Campos do modelo

  protected $table = 'adresses';

  protected $fillable = [
    'id',
    'postalCode',
    'street',
    'streetNumber',
    'complement',
    'reference',
    'neighborhood',
    'city',
    'state',
  ];


  public function responsible()
  {
      return $this->belongsTo(Responsible::class);
  }


  public function company()
  {
      return $this->belongsTo(Company::class);
  }
}

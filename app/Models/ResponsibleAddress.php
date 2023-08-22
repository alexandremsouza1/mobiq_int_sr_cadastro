<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ResponsibleAddress extends Model
{
  // Campos do modelo

  protected $fillable = [
    'responsibleId',
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
}

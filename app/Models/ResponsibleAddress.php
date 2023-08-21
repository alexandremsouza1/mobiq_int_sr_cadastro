<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ResponsibleAddress extends Model
{
  // Campos do modelo

  protected $fillable = [
    'responsible_street',
    'responsible_number',
    'responsible_postal_code',
    'responsible_address_complement',
    'responsible_address_reference_point',
    'responsible_city',
    'responsible_state',
  ];
}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Partner extends Model
{
  // Campos do modelo
  protected $fillable = [
    'partner_cpf',
    'first_member_name',
    'last_member_name',
    'partner_birth_date',
  ];
}

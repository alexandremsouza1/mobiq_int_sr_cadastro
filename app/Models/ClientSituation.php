<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientSituation extends Model
{
  protected $fillable = [
    'has_no_debt',
    'debt',
  ];


}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientSituation extends Model
{
  protected $fillable = [
    'clientId',
    'hasNoDebt',
    'debt',
  ];

  public function cliente()
  {
      return $this->belongsTo(Cliente::class);
  }


}

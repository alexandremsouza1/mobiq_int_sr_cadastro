<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientSituation extends BaseModel
{

  protected $table = 'client_situation';
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

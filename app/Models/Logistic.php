<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
  protected $fillable = [
    'key',
    'day_week',
    'from',
    'to',
    'work_shift',
    'service'
  ];


  //rules
  public static $rules = [
    'service' => Rule::in(['face-to-face', 'phone', 'digital']),
  ];


}

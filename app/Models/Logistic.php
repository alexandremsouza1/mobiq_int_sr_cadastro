<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Delivery extends Model
{
  protected $fillable = [
    'companyId',
    'availableDays',
    'availableHours',
    'attendanceMode',
    'openingStatus'
  ];

  protected $dates = [
    'created_at',
    'updated_at',
    'deleted_at',
  ];


  //rules
  public static $rules = [
    'attendanceMode' => Rule::in(['face-to-face', 'phone', 'digital']),
    'openingStatus' => Rule::in(['open', 'openingSoon', 'openingLater']),
  ];

  public function company()
  {
      return $this->belongsTo(Company::class);
  }


}

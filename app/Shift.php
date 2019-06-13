<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
  protected $fillable = [
      'user_id',
      'company_id',
      'date',
      'hourStart',
      'hourEnd',
      'breakTime',
      'hourSpec'
  ];

  public function companies()
  {
    return $this->hasMany('App\Company');
  }

  public function specialhours()
  {
    return $this->hasMany('App\SpecialHour');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialHour extends Model
{
  protected $fillable = [
    
    'name',
    'type',
    'operator',
    'value',
    'user_id',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}

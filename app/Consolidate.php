<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consolidate extends Model
{
  protected $fillable = [
      'user_id', 'week', 'company_id','q_hours','vl_salary'
  ];

  public function companies()
  {
    return $this->hasMany('App\Company');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}

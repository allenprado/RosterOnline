<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consolidate extends Model
{

  public function companies()
  {
    return $this->hasMany('App\Company');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}

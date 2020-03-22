<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
  public function user_point()
{
  return $this->hasOne('App\User');
}

public function get_point()
{
  return $this->point;
}
}

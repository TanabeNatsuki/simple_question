<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $guarded = array('id');

public function question()
{
  return $this->hasOne('App\Question');
}

public function getData()
{
  return $this->name;
}

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $guarded = array('id');

public function category()
{
  return $this->belongsTo('App\Category');
}

public function getData()
{
  return $this->name;
}

public function answer()
{
  return $this->hasMany('App\Answer');
}

public function getquestion()
{
  return $this->title;
}
}

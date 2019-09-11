<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
  protected $table = "m_owner";
  protected $primaryKey = "o_id";
public $timestamps = false;
}

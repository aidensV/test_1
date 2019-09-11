<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = "m_unit";
    protected $primaryKey = "u_id";
  public $timestamps = false;
}

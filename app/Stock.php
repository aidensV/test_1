<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
  protected $table = "d_stock";
  protected $primaryKey = "s_id";
public $timestamps = false;
}

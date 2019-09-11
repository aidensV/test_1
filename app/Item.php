<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $table = "m_item";
  protected $primaryKey = "i_id";
  public $timestamps = false;
}

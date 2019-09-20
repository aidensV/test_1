<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailDistribution extends Model
{
  protected $table = "d_stock_distribution_dt";
  // protected $primaryKey = "o_id";
  public $timestamps = false;

  protected $fillable = ['stock_distribution_id','detail_id','item_id','qty','unit'];

}

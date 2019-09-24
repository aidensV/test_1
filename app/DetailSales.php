<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSales extends Model
{
  protected $table = "d_sales_dt";
  protected $primaryKey = "sales_id";
  public $timestamps = false;
  protected $fillable = ['sales_id','detail_id','item_id','qty','value','total_net','unit_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DetailDistribution extends Model
{
  protected $table = "d_stock_distribution_dt";
  // protected $primaryKey = "o_id";
  public $timestamps = false;
// protected $primaryKey = 'stock_distribution_id';
protected function setKeysForSaveQuery(Builder $query)
    {
        $query
        ->where('stock_distribution_id', '=', $this->getAttribute('stock_distribution_id'))
        ->where('detail_id', '=', $this->getAttribute('detail_id'));
        return $query;
    }
  protected $fillable = ['stock_distribution_id','detail_id','item_id','qty','unit'];

}

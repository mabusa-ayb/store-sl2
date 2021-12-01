<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'code', 'name', 'selling_price',  'information', 'status', 'user_modified', 'stock_available','stock_total'
    ];

    public function user_modify(){
        return $this->belongsTo('App\User', 'user_modified');
    }

}

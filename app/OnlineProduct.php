<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineProduct extends Model
{
    protected $table = 'online_products';
    protected $fillable = ['name', 'product_id', 'slug','details','price','shipping_cost','description','category_id','image_path'];

    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }
}

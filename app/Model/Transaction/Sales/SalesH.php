<?php

namespace App\Model\Transaction\Sales;

use Illuminate\Database\Eloquent\Model;

class SalesH extends Model
{
    protected $table = 'sales_h';

    protected $fillable = [
        'num_invoice', 'total', 'active', 'shop_name', 'user_modified', 'date', 'information'
    ];

    public function user_modify(){
        return $this->belongsTo('\App\User', 'user_modified');
    }
}

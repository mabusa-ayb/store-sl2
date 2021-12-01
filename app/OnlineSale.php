<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineSale extends Model
{
    protected $table = 'online_sales';

    protected $fillable = ['email','invoiceNumber','paymentMethod','subtotal','shipping_cost','total','status'];
}

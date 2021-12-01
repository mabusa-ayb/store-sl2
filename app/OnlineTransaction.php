<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineTransaction extends Model
{
    protected $table = 'online_transactions';

    protected $fillable = ['invoiceNumber','product_id','quantity'];
}

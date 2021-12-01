<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineCustomer extends Model
{
    protected $table = 'online_customers';

    protected $fillable = ['fname','sname','phoneNumber','address1','address2','city','country'];
}

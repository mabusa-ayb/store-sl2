<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    protected $fillable = [
        'name', 'address',  'city', 'country', 'email', 'phone_number','cell_number','logo'
    ];
}

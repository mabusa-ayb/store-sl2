<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $fillable = ['user_id','fname','sname','phoneNumber','address1','address2','province','email','city','country'];
}

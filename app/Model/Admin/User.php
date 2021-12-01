<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function user_details(){
        return $this->hasOne('App\Model\Admin\UserType');
    }

}

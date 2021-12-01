<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';

    protected $fillable = [
        'user_id', 'account_type', 'user_modified',
    ];

    public function user_modify(){
        return $this->belongsTo('App\User', 'user_modified');
    }

    public function user(){
        return $this->belongsTo('App\Model\Admin\User', 'user_id');
    }

}

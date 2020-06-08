<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function user(){
        return $this->belongsToMany('App\User','role_user','role_id','user_id');
    }
    public $table = 'Roles';

    public function scopeOfName($query,$name){
        return $query->where('name','LIKE',$name);
    }
}

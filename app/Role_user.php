<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_user extends Model
{
    public $table = 'role_user';
//    public function role(){
//        return $this->hasMany('App\Role','role_id','');
//    }
//    public function user(){
//        return $this->hasMany('App\User');
//    }
    public function scopeOfRoleID($query,$role_id){
        return $query->where('role_id',$role_id);
    }
    public function scopeOfRoleName($query,$role_name){
        return $query->role()->ofName($role_name);
    }
}

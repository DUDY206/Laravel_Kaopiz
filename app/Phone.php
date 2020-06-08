<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    protected $table = 'phones';

    public function scopeOfNumber($query, $type){
        return $query->where('number','LIKE',$type);
    }
}

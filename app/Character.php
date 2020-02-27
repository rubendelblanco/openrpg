<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'experience',
        'level',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}

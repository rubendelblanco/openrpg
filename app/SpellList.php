<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpellList extends Model
{ 
    protected $fillable = [
        'title',
        'description',
        'notes',
        'list_type',
    ];

    public function spells(){
        return $this->hasMany('App\Spell');
    }
}

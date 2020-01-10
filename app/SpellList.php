<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpellList extends Model
{
    public function spells(){
        return $this->hasMany('App\Spell');
    }
}

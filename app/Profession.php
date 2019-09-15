<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $casts = [
        'spell_realms' => 'array'
    ];
}

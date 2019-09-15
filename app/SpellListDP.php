<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpellListDP extends Model
{
    protected $fillable = [
        'spell_user_type', 'own_realm', 'other_realm', 'is_editable'
    ];
}

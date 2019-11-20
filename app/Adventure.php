<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adventure extends Model
{
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adventure extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'description',
        'gamemaster_id',
    ];

    /**
     * Retrieves the user that acts as a gamemaster for this campaign.
     */
    public function gamemaster()
    {
        return $this->belongsTo('App\User', 'gamemaster_id');
    }

    /**
     * Retrieves the list of adventures associated with this campaign.
     */
    public function adventures()
    {
        return $this->hasMany('App\Adventure');
    }
}

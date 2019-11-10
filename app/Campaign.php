<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    /**
     * Retrieves the user that acts as a gamemaster for this campaign.
     */
    public function gamemaster()
    {
        return $this->belongsTo('App\User', 'gamemaster_id');
    }
}

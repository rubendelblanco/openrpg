<?php

namespace App\Http\Resources\Campaigns;

use App\Http\Resources\LinkedCollection;

class CampaignCollection extends LinkedCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

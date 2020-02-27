<?php

namespace App\Http\Resources\Campaigns;

use App\Http\Resources\LinkedResource;
use Illuminate\Support\Facades\URL;

class Campaign extends LinkedResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

    public function links($request)
    {
        return [
            'self' => URL::route('campaigns.show', ['campaign' => $this->id]),
        ];
    }
}

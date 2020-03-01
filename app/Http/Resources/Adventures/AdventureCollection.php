<?php

namespace App\Http\Resources\Adventures;

use App\Http\Resources\LinkedCollection;

class AdventureCollection extends LinkedCollection
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

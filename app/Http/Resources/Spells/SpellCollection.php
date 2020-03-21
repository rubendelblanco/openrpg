<?php

namespace App\Http\Resources\Spells;

use App\Http\Resources\LinkedCollection;

class SpellCollection extends LinkedCollection
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

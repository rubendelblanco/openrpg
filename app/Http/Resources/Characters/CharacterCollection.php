<?php

namespace App\Http\Resources\Characters;

use App\Http\Resources\LinkedCollection;

class CharacterCollection extends LinkedCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

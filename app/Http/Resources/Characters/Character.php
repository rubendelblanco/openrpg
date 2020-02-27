<?php

namespace App\Http\Resources\Characters;

use Illuminate\Support\Facades\URL;
use App\Http\Resources\LinkedResource;

class Character extends LinkedResource
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
            'name' => $this->name,
            'experience' => $this->experience,
            'level' => $this->level,
        ];
    }

    public function links($request)
    {
        return [
            'self' => URL::route('characters.show', ['character' => $this->id]),
        ];
    }
}

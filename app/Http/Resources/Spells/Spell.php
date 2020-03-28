<?php

namespace App\Http\Resources\Spells;

use App\Http\Resources\LinkedResource;
use Illuminate\Support\Facades\URL;

class Spell extends LinkedResource
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
            'level' => $this->level,
            'name' => $this->name,
            'description' => $this->description,
            'list_name' => $this->list_name,
            'code' => $this->code,
            'class' => $this->class,
            'effect_area' => json_decode($this->effect_area),
            'duration' => json_decode($this->duration),
            'notes' => $this->notes,
            'list_id' => $this->list_id,
        ];
    }

    public function links($request)
    {
        return [
            'self' => URL::route('spell-lists.spells.show', [
                'spell_list' => $this->list_id,
                'spell' => $this->id,
            ]),
            'spell_list' => URL::route('spell-lists.show', ['spell_list' => $this->list_id]),
        ];
    }
}

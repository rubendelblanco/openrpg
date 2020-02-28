<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\LinkedResource;
use Illuminate\Support\Facades\URL;

class User extends LinkedResource
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
            'email' => $this->email,
        ];
    }

    public function links($request)
    {
        return [
            'self' => URL::route('users.show', ['user' => $this->id]),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LinkedCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data' => $this->linkedCollection($request)];
    }

    protected function linkedCollection($request)
    {
        return $this->collection->map(function ($resource) use ($request) {
            return array_merge($resource->toArray($request), [
                "links" => $resource->links($request),
            ]);
        });
    }
}

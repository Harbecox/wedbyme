<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterGroupResource extends JsonResource
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
            'position' => $this->position,
            'type' => $this->type,
            'name' => $this->name,
            'cat' => $this->cat,
            'items' => FilterResource::make($this->items)
        ];
    }
}

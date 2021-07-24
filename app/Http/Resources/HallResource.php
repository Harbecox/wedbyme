<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HallResource extends JsonResource
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
            'coords' => $this->coords,
            'address' => $this->address,
            'region' => $this->region,
            'review' => $this->review,
            'phones' => $this->phones,
            'images' => $this->images,
            'title'  => $this->title,
            'seo_url' => $this->seo_url,
            'calendar' => CalendarResource::make($this->calendar),
            'filters' => HallFilterResource::collection($this->filters)
        ];
    }
}



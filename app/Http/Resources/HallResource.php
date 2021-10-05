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
            'review' => $this->review,
            'phones' => $this->phones,
            'images' => $this->images,
            'title'  => $this->title,
            'seo_url' => $this->seo_url,
            'urls' => $this->urls,
            'description' => $this->description,
            'calendar' => CalendarResource::make($this->calendar),
            'filters' => $this->whenLoaded("filters",HallFilterResource::collection($this->filters)),
            'company' => $this->whenLoaded("company",CompanyResource::make($this->company))
        ];
    }
}



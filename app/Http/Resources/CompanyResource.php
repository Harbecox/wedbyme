<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'title' => $this->title,
            'seo_url' => $this->seo_url,
            'logo' => $this->logo,
            'about' => $this->about,
            'role' => $this->role,
            'urls' => $this->urls,
            'created_at' => $this->created_at,
            'halls' => HallResource::collection($this->whenLoaded('halls')),
            'services' => ServiceResource::collection($this->whenLoaded("services"))
        ];
    }
}

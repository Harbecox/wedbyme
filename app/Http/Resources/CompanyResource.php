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
            'logo' => $this->logo,
            'about' => $this->about,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'halls' => HallResource::collection($this->whenLoaded('halls'))
        ];
    }
}

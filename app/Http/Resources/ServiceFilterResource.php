<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceFilterResource extends JsonResource
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
            "filter_id" => $this->filter_id,
            "filter_group_id" => $this->filter->filter_group->id,
            "filter" => [
                "title" => $this->filter->title,
                "value" => $this->filter->value,
            ],
            "filter_group" => [
                "title" => $this->filter->filter_group->title,
                "type" => $this->filter->filter_group->type,
                "options" => $this->filter->filter_group->options,
            ]
        ];
    }
}

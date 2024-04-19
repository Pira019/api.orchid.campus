<?php

namespace App\Http\Resources\Manager\ShowService;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryStepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id" => $this->id,
            "title" => $this->title,
            "visibility" => $this->visibility,
            "description" => $this->description,
        ];
    }
}

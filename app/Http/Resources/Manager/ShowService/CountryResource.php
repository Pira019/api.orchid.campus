<?php

namespace App\Http\Resources\Manager\ShowService;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            "name" => $this->name,
            "flag_url" => $this->flag_url,
            "steps" =>  CountryStepResource::collection($this->countrySteps),
        ];
    }
}

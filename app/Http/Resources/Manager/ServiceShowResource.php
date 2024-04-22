<?php

namespace App\Http\Resources\Manager;

use App\Http\Resources\Manager\ShowService\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->service->id,
            "price" => $this->service->price,
            "currency" => $this->service->currency,
            "year" => $this->service->year,
            "created_at" => $this->service->created_at,
            "updated_at" => $this->service->updated_at,
            "status" => $this->service->status,
            "disciplanaries" => DisciplinaryResource::collection($this->service->disciplinaries),
            "countries" => new CountryResource($this->service->country),
            "universities" =>  $this->universities,
        ];
    }
}

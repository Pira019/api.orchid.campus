<?php

namespace App\Http\Resources\Manager\University\GetProgramAmssionDate;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
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
            "label" => $this->label,
            "id" => $this->id,
            "cycle" => $this->cycle,
            "admission_date" => AdmissionDateResource::collection($this->admissionDate)
        ];
    }
}

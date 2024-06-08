<?php

namespace App\Http\Resources\Manager\University\GetProgramAmssionDate;

use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionDateResource extends JsonResource
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
            "start_at" => $this->start_at,
            "end_at" => $this->end_at,
            "session_admission" => $this->session_admission,
            "updated_at" => $this->updated_at, 
        ];
    }
}

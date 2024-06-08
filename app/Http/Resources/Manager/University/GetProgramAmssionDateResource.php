<?php

namespace App\Http\Resources\Manager\University;

use App\Http\Resources\Manager\University\GetProgramAmssionDate\ProgramResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetProgramAmssionDateResource extends JsonResource
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
            "logo" => $this->logo,
            "updated_at" => $this->updated_at,
            "programs" => ProgramResource::collection($this->programs)
        ];
    }
}

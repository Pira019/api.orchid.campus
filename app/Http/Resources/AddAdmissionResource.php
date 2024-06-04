<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddAdmissionResource extends JsonResource
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
            "link" =>  $this->link,
            "session_admission" =>  $this->session_admission,
            "type" =>  $this->type,
            "start_at" =>  $this->start_at,
            "end_at" =>  $this->end_at,
            "end_at" =>  $this->end_at,
            "updated_at" =>  $this->updated_at,
            "year" =>  $this->year,
        ];
    }
}


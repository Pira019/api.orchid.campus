<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExtraTutorialResource extends JsonResource
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
            "id" =>  $this->id,
            "token" =>  $this->link_video,
            "signature" => $this->signature,
            "creator" =>  $this->creator,
            "visibility" => true,
            "updated_at"=>  $this->updated_at
        ];
    }
}


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
            "tutorial_id" =>  $this->tutorial_id,
            "token" =>  $this->link_video,
            "signature"=> null,
            "comment"=>  $this->comment,
            "isPrivate"=>  $this->isPrivate,
            "creator" =>  $this->creator,
            "visibility" => null,
            "updated_at "=>  $this->updated_at
        ];
    }
}

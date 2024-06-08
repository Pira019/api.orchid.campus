<?php

namespace App\Http\Resources\Manager;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileManagerResource extends JsonResource
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
            "user_name" => $this->user_name,
            "email" => $this->email,
            "created_at" => $this->created_at,
            "profile" => $this->profil->name,
            "name" => $this->customer->name,
            "first_name" => $this->customer->first_name,
            "sex" => $this->customer->sex,
            "residence_country" => $this->customer?->country?->name,
            "phone" => $this->customer->phone,
            "birth_date" => Carbon::parse($this->customer?->birth_date)->format('d-m'). '-xxxx'
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccessConcentratorResource extends JsonResource
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
            "id" => $this->subscription_id,
            "customer_id" => $this->customer_id,
            "name" => $this->name,
            "site_id" => $this->site_id,
            "connect_to_address" => $this->radius_src_address,
            "suspended" => $this->suspended,
        ];
    }
}

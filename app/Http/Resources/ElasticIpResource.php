<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ElasticIpResource extends JsonResource
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
            "ip_address" => $this->ip_address,
            "id" => $this->subscription_id,
            "customer_id" => $this->customer_id,
            "name" => $this->name,
            "ptr_record" => $this->ptr_record
            //relationship to ip assigment
        ];
    }
}

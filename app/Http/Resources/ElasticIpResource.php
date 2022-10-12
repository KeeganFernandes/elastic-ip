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
            "name" => $this->name,
            "ptr_record" => $this->ptr_record,
            "l2tp_connection" => new ElasticIpAddressAssignmentResource($this->elastic_ip_address_assignment)
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ElasticIpAddressAssignmentResource extends JsonResource
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
            "connect_to_address" => $this->access_concentrator->radius_src_address,
            "username" => $this->username,
            "password" => $this->password,
        ];
    }
}

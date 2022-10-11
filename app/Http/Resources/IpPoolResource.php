<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IpPoolResource extends JsonResource
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
            "id" => $this->uuid,
            "range_start" => $this->range_start,
            "range_end" => $this->range_end,
        ];
    }
}

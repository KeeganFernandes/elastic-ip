<?php

namespace App\Traits;

use App\Models\ElasticIpAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait AvailableIpRanges
{
    public function getNextAvailableIp()
    {
        $ip_pools = $this->ip_pools;

        if (!filled($ip_pools)) {
            return false;
        }

        $elastic_ips = ElasticIpAddress::select(["ip_address"])->where("cooldown" , ">", now()->format("Y-m-d H:i:s"))->orWhere(["cooldown" => null])->get();

        $elastic_ips->transform(function ($value)
        {
            return ip2long($value->ip_address);
        });

        $new_ip_pools = $ip_pools->map(function ($value) use ($elastic_ips)
        {
            $items = [];

            for ($i=ip2long($value->range_start); $i <= ip2long($value->range_end); $i++) {
                if (!in_array($i, $elastic_ips->toArray())) {
                    $items[] = $i;
                }   
            }

            return $items;
        });

        return long2ip($new_ip_pools->flatten()->sort()->first());
    }
}

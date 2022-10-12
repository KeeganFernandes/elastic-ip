<?php

namespace App\Models;

use App\Traits\AccessConcentratorRadiusSecret;
use App\Traits\AvailableIpRanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessConcentrator extends Model
{
    use HasFactory;
    use AccessConcentratorRadiusSecret;
    use AvailableIpRanges;

    protected $fillable = [
        "name",
        "site_id",
        "customer_id",
        "subscription_id",
        "radius_secret",
        "radius_src_address",
        "suspended",
    ];

    public function ip_pools()
    {
        return $this->belongsToMany(IpPool::class);
    }
}

<?php

namespace App\Models;

use App\Casts\IpAddressCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElasticIpAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        "ip_address",
        "subscription_id",
        "customer_id",
        "name",
        "ptr_record",
        "suspended",
    ];

    protected $casts = [
        "ip_address" => IpAddressCast::class,
    ];

    public function ip_pools()
    {
        return $this->hasMany(IpPool::class);
    }

    public function elastic_ip_address_assignment()
    {
        return $this->hasOne(ElasticIpAddressAssignment::class);
    }
}
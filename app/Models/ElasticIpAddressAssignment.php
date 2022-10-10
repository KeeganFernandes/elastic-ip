<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElasticIpAddressAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        "elastic_ip_address_id",
        "access_concentrator_id",
        "site_id",
        "username",
        "password"
    ];

    public function elastic_ip()
    {
        return $this->belongsTo(ElasticIpAddress::class);
    }

    public function access_concentrator()
    {
        return $this->belongsTo(AccessConcentrator::class);
    }
}

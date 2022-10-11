<?php

namespace App\Models;

use App\Casts\IpAddressCast;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPool extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        "range_start",
        "range_end",
        "customer_id"
    ];

    protected $casts = [
        "range_start" => IpAddressCast::class,
        "range_end" => IpAddressCast::class
    ];

    public function access_concentrator()
    {
        return $this->belongsToMany(AccessConcentrator::class);
    }
}

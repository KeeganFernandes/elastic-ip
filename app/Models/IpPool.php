<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPool extends Model
{
    use HasFactory;

    protected $fillable = [
        "range_start",
        "range_end",
        "customer_id"
    ];

    public function access_concentrator()
    {
        return $this->belongsToMany(AccessConcentrator::class);
    }
}

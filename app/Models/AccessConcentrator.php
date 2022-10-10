<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessConcentrator extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "site_id",
        "customer_id"
    ];

    public function ip_pools()
    {
        return $this->hasMany(IpPool::class);
    }
}

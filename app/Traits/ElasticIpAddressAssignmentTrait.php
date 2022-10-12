<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ElasticIpAddressAssignmentTrait
{
    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->radius_secret)) {
                $model->username = Str::random(26);
                $model->password = Str::random(26);
            }
        });
    }
}

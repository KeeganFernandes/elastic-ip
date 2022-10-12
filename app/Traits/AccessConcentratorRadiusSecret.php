<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait AccessConcentratorRadiusSecret
{
    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->radius_secret)) {
                $model->radius_secret = Str::random(24);
            }
        });
    }
}

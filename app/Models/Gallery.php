<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'order',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('home.galleries');
            Cache::forget('home.galleries.total');
        });
        static::deleted(function () {
            Cache::forget('home.galleries');
            Cache::forget('home.galleries.total');
        });
    }
}

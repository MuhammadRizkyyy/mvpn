<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MisiItem extends Model
{
    protected $fillable = [
        'text',
        'order',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.misiitems'));
        static::deleted(fn () => Cache::forget('home.misiitems'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Kegiatan extends Model
{
    public const CATEGORIES = [
        'pendidikan' => 'Pendidikan',
        'wirausaha' => 'Wirausaha',
        'sdm' => 'SDM',
    ];

    protected $fillable = [
        'category',
        'title',
        'description',
        'is_coming_soon',
        'order',
    ];

    protected $casts = [
        'is_coming_soon' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.kegiatans'));
        static::deleted(fn () => Cache::forget('home.kegiatans'));
    }
}

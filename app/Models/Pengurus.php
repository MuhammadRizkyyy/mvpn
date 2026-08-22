<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pengurus extends Model
{
    use HasAutoTranslations;

    protected $table = 'pengurus';

    protected $fillable = [
        'section',
        'name',
        'position',
        'photo',
        'photo_public_id',
        'instagram_url',
        'linkedin_url',
        'order',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.pengurus'));
        static::deleted(fn () => Cache::forget('home.pengurus'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    public const SECTIONS = [
        'bod' => 'Board of Directors',
        'sekretaris' => 'Sekretaris',
        'ekonomi' => 'Ekonomi',
        'internasional' => 'Internasional',
        'itdev' => 'IT Development',
    ];

    protected $fillable = [
        'section',
        'name',
        'position',
        'photo',
        'photo_public_id',
        'instagram_url',
        'linkedin_url',
        'order',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.pengurus'));
        static::deleted(fn () => Cache::forget('home.pengurus'));
    }
}

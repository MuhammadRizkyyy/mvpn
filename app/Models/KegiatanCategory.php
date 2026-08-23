<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class KegiatanCategory extends Model
{
    use HasAutoTranslations;

    protected $fillable = [
        'slug',
        'name',
        'icon',
        'description',
        'show_language_pills',
        'order',
        'translations',
    ];

    protected $casts = [
        'show_language_pills' => 'boolean',
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.kegiatan_categories'));
        static::deleted(fn () => Cache::forget('home.kegiatan_categories'));
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'category', 'slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public static function ordered()
    {
        return static::orderBy('order')->orderBy('id')->get();
    }

    public static function cached()
    {
        return Cache::remember('home.kegiatan_categories', 3600, fn () => static::ordered());
    }
}

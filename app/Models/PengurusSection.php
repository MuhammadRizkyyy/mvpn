<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PengurusSection extends Model
{
    use HasAutoTranslations;

    protected $fillable = [
        'slug',
        'name',
        'order',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.pengurus_sections'));
        static::deleted(fn () => Cache::forget('home.pengurus_sections'));
    }

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class, 'section', 'slug');
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
        return Cache::remember('home.pengurus_sections', 3600, fn () => static::ordered());
    }
}

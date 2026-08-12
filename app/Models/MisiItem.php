<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MisiItem extends Model
{
    protected $fillable = [
        'text',
        'order',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.misiitems'));
        static::deleted(fn () => Cache::forget('home.misiitems'));
    }

    public function translated(string $field): string
    {
        $source = (string) ($this->{$field} ?? '');
        $locale = app()->getLocale();

        if ($locale === 'id' || $source === '') {
            return $source;
        }

        $value = $this->translations[$locale][$field] ?? null;

        return filled($value) ? $value : $source;
    }
}

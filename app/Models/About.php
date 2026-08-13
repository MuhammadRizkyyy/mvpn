<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class About extends Model
{
    protected $fillable = [
        'title',
        'paragraph_1',
        'paragraph_2',
        'paragraph_3',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.about'));
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

    public static function singleton(): self
    {
        $about = static::find(1);

        if (! $about) {
            $about = new static();
            $about->id = 1;
            $about->save();
        }

        return $about;
    }
}

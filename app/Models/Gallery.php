<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    protected $fillable = [
        'image',
        'image_public_id',
        'title',
        'description',
        'order',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    public function getDescriptionHtmlAttribute(): string
    {
        if (blank($this->description)) {
            return '';
        }

        if ($this->description === strip_tags($this->description)) {
            return nl2br(e($this->description));
        }

        return $this->description;
    }

    public function translatedTitle(): ?string
    {
        $locale = app()->getLocale();

        if ($locale === 'id' || blank($this->title)) {
            return $this->title;
        }

        $value = $this->translations[$locale]['title'] ?? null;

        return filled($value) ? $value : $this->title;
    }

    /**
     * Plain-text (tag-free) description, translated when the active locale
     * isn't the source locale. Rich formatting is only preserved for the
     * source (Indonesian) content — see translatedDescriptionHtml().
     */
    public function translatedDescriptionPlain(): string
    {
        $plain = html_entity_decode(strip_tags((string) $this->description), ENT_QUOTES);
        $locale = app()->getLocale();

        if ($locale === 'id' || $plain === '') {
            return $plain;
        }

        $value = $this->translations[$locale]['description'] ?? null;

        return filled($value) ? $value : $plain;
    }

    public function translatedDescriptionHtml(): string
    {
        if (app()->getLocale() === 'id') {
            return $this->description_html;
        }

        $text = $this->translatedDescriptionPlain();

        return $text === '' ? '' : nl2br(e($text));
    }

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

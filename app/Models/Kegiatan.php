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
        'translations',
    ];

    protected $casts = [
        'is_coming_soon' => 'boolean',
        'translations' => 'array',
    ];

    public function translatedTitle(): ?string
    {
        $locale = app()->getLocale();

        if ($locale === 'id' || blank($this->title)) {
            return $this->title;
        }

        return filled($this->translations[$locale]['title'] ?? null)
            ? $this->translations[$locale]['title']
            : $this->title;
    }

    public function translatedDescriptionHtml(): string
    {
        $locale = app()->getLocale();

        if ($locale === 'id' || blank($this->description)) {
            return $this->description_html;
        }

        $text = $this->translations[$locale]['description'] ?? null;

        if (blank($text)) {
            $text = \App\Services\TranslationService::htmlToPlain($this->description);
        }

        return $text === '' ? '' : nl2br(e($text));
    }

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

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.kegiatans'));
        static::deleted(fn () => Cache::forget('home.kegiatans'));
    }
}

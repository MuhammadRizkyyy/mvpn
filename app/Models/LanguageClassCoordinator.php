<?php

namespace App\Models;

use App\Models\Concerns\HasAutoTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LanguageClassCoordinator extends Model
{
    use HasAutoTranslations;

    public const LANGUAGES = [
        'inggris' => 'Inggris',
        'jerman' => 'Jerman',
        'prancis' => 'Prancis',
        'mandarin' => 'Mandarin',
        'arab' => 'Arab',
        'turki' => 'Turki',
        'korea' => 'Korea',
    ];

    protected $fillable = [
        'language',
        'name',
        'role',
        'photo',
        'photo_public_id',
        'period',
        'certificate',
        'certificate_public_id',
        'order',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.language_coordinators'));
        static::deleted(fn () => Cache::forget('home.language_coordinators'));
    }
}

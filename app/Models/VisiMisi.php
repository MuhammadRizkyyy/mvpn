<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class VisiMisi extends Model
{
    protected $table = 'visi_missions';

    protected $fillable = [
        'visi_text',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.visimisi'));
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
        $visiMisi = static::find(1);

        if (! $visiMisi) {
            $visiMisi = new static();
            $visiMisi->id = 1;
            $visiMisi->save();
        }

        return $visiMisi;
    }
}

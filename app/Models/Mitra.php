<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Mitra extends Model
{
    public const CATEGORIES = [
        'media' => 'Media',
        'community' => 'Komunitas',
        'government' => 'Pemerintahan',
        'hospitality_campus' => 'Hospitality & Kampus',
        'hotel' => 'Hotel',
        'brand' => 'Brand',
        'law' => 'Hukum',
        'ip_trade' => 'IP & Perdagangan',
    ];

    protected $fillable = [
        'category',
        'name',
        'logo',
        'logo_public_id',
        'order',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.mitra'));
        static::deleted(fn () => Cache::forget('home.mitra'));
    }

    // Logos are stored as absolute Cloudinary URLs. Any remaining rows with a
    // relative 'assets/...' path are legacy seed data pointing at local static files.
    public function getLogoUrlAttribute(): string
    {
        if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
            return $this->logo;
        }

        return str_starts_with($this->logo, 'assets/')
            ? asset($this->logo)
            : asset('storage/' . $this->logo);
    }
}

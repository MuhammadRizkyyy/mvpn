<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'order',
    ];

    // Seeded rows point at public/assets/img (legacy static files); admin uploads
    // go through Storage::disk('public') and are stored relative to storage/app/public.
    public function getLogoUrlAttribute(): string
    {
        return str_starts_with($this->logo, 'assets/')
            ? asset($this->logo)
            : asset('storage/' . $this->logo);
    }
}

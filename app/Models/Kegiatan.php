<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'is_coming_soon' => 'boolean',
    ];
}

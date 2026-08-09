<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Gallery extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'order',
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

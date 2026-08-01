<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class VisiMisi extends Model
{
    protected $table = 'visi_missions';

    protected $fillable = [
        'visi_text',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('home.visimisi'));
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_missions';

    protected $fillable = [
        'visi_text',
    ];

    public static function singleton(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}

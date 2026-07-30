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
        $visiMisi = static::find(1);

        if (! $visiMisi) {
            $visiMisi = new static();
            $visiMisi->id = 1;
            $visiMisi->save();
        }

        return $visiMisi;
    }
}

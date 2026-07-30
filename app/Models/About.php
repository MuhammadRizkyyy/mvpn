<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'paragraph_1',
        'paragraph_2',
        'paragraph_3',
    ];

    public static function singleton(): self
    {
        $about = static::find(1);

        if (! $about) {
            $about = new static();
            $about->id = 1;
            $about->save();
        }

        return $about;
    }
}

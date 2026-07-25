<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    public const SECTIONS = [
        'bod' => 'Board of Directors',
        'sekretaris' => 'Sekretaris',
        'ekonomi' => 'Ekonomi',
        'internasional' => 'Internasional',
        'itdev' => 'IT Development',
    ];

    protected $fillable = [
        'section',
        'name',
        'position',
        'photo',
        'instagram_url',
        'order',
    ];
}

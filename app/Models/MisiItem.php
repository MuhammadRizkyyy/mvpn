<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MisiItem extends Model
{
    protected $fillable = [
        'text',
        'order',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'visitor_uuid',
        'visited_date',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'visited_date' => 'date',
    ];

    public static function todayCount(): int
    {
        return static::whereDate('visited_date', now()->toDateString())->count();
    }

    public static function totalUniqueCount(): int
    {
        return static::distinct('visitor_uuid')->count('visitor_uuid');
    }
}

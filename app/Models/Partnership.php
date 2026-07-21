<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $fillable = [
        'institution_name',
        'pic_name',
        'email',
        'summary',
        'proposal_file',
        'status',
    ];
}




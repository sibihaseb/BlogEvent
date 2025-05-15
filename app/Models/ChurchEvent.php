<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchEvent extends Model
{
    protected $fillable = [
        'picture',
        'name',
        'description',
        'start_time',
        'end_time',
        'location',
        'type'
    ];
}

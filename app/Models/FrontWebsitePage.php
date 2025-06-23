<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontWebsitePage extends Model
{
    protected $fillable = [
        'key',
        'value'
    ];

    protected $casts = [
        'value' => 'json'
    ];
}

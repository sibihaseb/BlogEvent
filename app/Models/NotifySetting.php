<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifySetting extends Model
{
    protected $fillable = [
        'page',
        'emails',
    ];
}

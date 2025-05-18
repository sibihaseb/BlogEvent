<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchEvent extends Model
{
    protected $fillable = [
        'picture',
        'name',
        'short_description',
        'description',
        'start_time',
        'end_time',
        'location',
        'type'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}

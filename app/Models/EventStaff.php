<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventStaff extends Model
{
    protected $fillable = [
        'name',
        'position',
        'image'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }
}

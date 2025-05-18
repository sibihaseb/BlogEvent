<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function getIconUrlAttribute()
    {
        return asset('storage/' . $this->icon);
    }
}

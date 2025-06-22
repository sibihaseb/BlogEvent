<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrequentlyQuestion extends Model
{


    protected $fillable = [
        'question',
        'answer',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('question', 'like', '%' . $filters['search'] . '%')
                ->orWhere('answer', 'like', '%' . $filters['search'] . '%');
        }
    }
}

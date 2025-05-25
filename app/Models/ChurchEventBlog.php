<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchEventBlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'short_description',
        'description',
        'image',
    ];
    protected $appends = ['image_url'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}

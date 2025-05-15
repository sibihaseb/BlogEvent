<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ChurchEventTag::class, 'event_tag', 'church_event_id', 'church_event_tag_id');
    }
}

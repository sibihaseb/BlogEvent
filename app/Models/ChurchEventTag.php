<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchEventTag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function churchEvents()
    {
        return $this->belongsToMany(ChurchEvent::class,  'event_tag', 'church_event_id', 'church_event_tag_id');
    }
}

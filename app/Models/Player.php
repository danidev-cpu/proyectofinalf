<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'number',
        'twitter',
        'instagram',
        'twitch',
        'photo',
        'position',
        'country',
        'visible'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_player');
    }
}

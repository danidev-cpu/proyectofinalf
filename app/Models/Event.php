<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'map',
        'date',
        'hour',
        'type',
        'tags',
        'visible',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'event_player');
    }
}

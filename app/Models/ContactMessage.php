<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /** @use HasFactory<\Database\Factories\ContactMessageFactory> */
    use HasFactory;

    protected $table = 'contact_messages';

    protected $fillable = [
        'name',
        'email',
        'message',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

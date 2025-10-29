<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'position',
        'score',
        'remarks',
    ];

    /**
     * Get the event that the result belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user for the result.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'user_id',
        'status',
        'registration_date',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
    ];

    /**
     * Get the event that the registration belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Get the user that made the registration.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the certificate for this registration.
     */
    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'type',
        'start_date',
        'end_date',
        'cover_image_path_name',
        'capacity',
        'is_volunteers_required',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_volunteers_required' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'event_has_volunteers', 'event_id', 'user_id')->withTimestamps()->withPivot('status');
    }

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($this->start_time > $now) {
            return 'upcoming';
        } elseif ($this->start_time <= $now && $this->end_time >= $now) {
            return 'live';
        } elseif ($this->end_time < $now) {
            return 'completed';
        }

        return 'unknown'; 
    }
}

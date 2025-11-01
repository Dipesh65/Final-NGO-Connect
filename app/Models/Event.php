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

    // Ensure start_date and end_date are Carbon instances
    $start = Carbon::parse($this->start_date);
    $end = Carbon::parse($this->end_date);

    if ($start->isFuture()) {
        return 'upcoming';
    } elseif ($now->between($start, $end)) {
        return 'live';
    } elseif ($end->isPast()) {
        return 'completed';
    }

    return 'unknown';
}

}

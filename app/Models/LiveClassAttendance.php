<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClassAttendance extends Model
{
    protected $fillable = ['user_id', 'live_class_id', 'joined_at', 'left_at', 'duration_stayed', 'is_present'];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
        'is_present' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liveClass()
    {
        return $this->belongsTo(LiveClass::class);
    }
}

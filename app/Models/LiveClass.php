<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiveClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'batch_id', 'title', 'description', 
        'start_time', 'duration', 'meeting_id', 'meeting_password', 
        'join_url', 'provider', 'recording_url', 'is_archived'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'is_archived' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}

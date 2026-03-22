<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'name', 'start_date', 'end_date', 'capacity', 'status'];
    protected $casts = ['start_date' => 'datetime', 'end_date' => 'datetime'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function liveClasses()
    {
        return $this->hasMany(LiveClass::class);
    }
}

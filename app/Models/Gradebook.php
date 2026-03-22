<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    protected $fillable = ['user_id', 'course_id', 'average_score', 'total_completed_lessons', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseQna extends Model
{
    protected $fillable = ['course_id', 'user_id', 'question', 'answer', 'answered_by', 'is_private'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'answered_by');
    }
}

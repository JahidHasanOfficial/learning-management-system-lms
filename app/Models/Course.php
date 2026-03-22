<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'thumbnail',
        'instructor_id',
        'status',
        'is_featured',
    ];

    /**
     * Get the instructor of the course.
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Get the students of the course.
     */
    public function students()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('progress', 'status', 'enrolled_at', 'completed_at')
            ->withTimestamps();
    }
}

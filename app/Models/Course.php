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
        'category_id',
        'career_path',
        'status',
        'is_featured',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('sort_order');
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function liveClasses()
    {
        return $this->hasMany(LiveClass::class);
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('progress', 'status', 'enrolled_at', 'completed_at')
            ->withTimestamps();
    }

    /**
     * Get the course thumbnail.
     */
    public function getThumbnailAttribute($value)
    {
        if (!$value) {
            return asset('frontend/img/course-1.jpg');
        }

        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        // Check if file exists in storage/app/public
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }

        return asset('frontend/img/course-1.jpg');
    }

    /**
     * Get average rating.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }
}

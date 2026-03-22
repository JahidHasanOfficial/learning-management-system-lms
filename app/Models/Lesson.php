<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id', 'title', 'type', 'content', 'file_path', 
        'video_url', 'video_provider', 'video_duration', 'is_preview', 'sort_order'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function progress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function isCompletedBy($user_id)
    {
        return $this->progress()->where('user_id', $user_id)->where('is_completed', true)->exists();
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'profile_image', 'phone', 'phone_verified_at', 'otp_code', 'otp_expires_at', 'provider', 'provider_id', 'address', 'bio', 'skills', 'status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
        ];
    }

    /**
     * Get the profile image URL.
     */
    public function getProfileImageAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
        return asset('backend/images/layout_img/user_img.jpg'); // Default placeholder
    }
    /**
     * Get the enrolled courses of the user.
     */
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class)
            ->withPivot('progress', 'status', 'enrolled_at', 'completed_at')
            ->withTimestamps();
    }

    /**
     * Get the login history of the user.
     */
    public function loginHistories()
    {
        return $this->hasMany(LoginHistory::class);
    }

    /**
     * Get the courses that the user is instructing.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_instructor')
            ->withPivot('role')
            ->withTimestamps();
    }
}

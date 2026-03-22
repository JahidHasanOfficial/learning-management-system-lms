<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClassChat extends Model
{
    protected $fillable = ['user_id', 'live_class_id', 'message', 'is_instructor'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liveClass()
    {
        return $this->belongsTo(LiveClass::class);
    }
}

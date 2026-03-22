<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationSlot extends Model
{
    protected $fillable = ['mentor_id', 'user_id', 'start_time', 'end_time', 'status', 'meeting_link'];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorAssignment extends Model
{
    protected $fillable = ['mentor_id', 'user_id', 'batch_id', 'status'];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'type', 'value', 'expire_at', 'status'];

    public function isValid()
    {
        return $this->status === 'active' && ($this->expire_at === null || $this->expire_at > now());
    }
}

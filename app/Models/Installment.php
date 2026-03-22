<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $fillable = ['payment_id', 'amount', 'due_date', 'paid_at', 'status', 'transaction_id'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RefundRequest;
use App\Models\Payment;
use App\Models\User;

class RefundRequestSeeder extends Seeder
{
    public function run(): void
    {
        $payments = Payment::take(2)->get();
        if ($payments->isEmpty()) return;

        foreach ($payments as $payment) {
            RefundRequest::create([
                'payment_id' => $payment->id,
                'user_id' => $payment->invoice->user_id,
                'reason' => 'I would like to request a refund for this course.',
                'status' => 'pending',
            ]);
        }
    }
}

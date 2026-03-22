<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Installment;
use App\Models\Payment;

class InstallmentSeeder extends Seeder
{
    public function run(): void
    {
        $payments = Payment::take(3)->get();
        if ($payments->isEmpty()) return;

        foreach ($payments as $payment) {
            Installment::create([
                'payment_id' => $payment->id,
                'amount' => $payment->amount / 2,
                'due_date' => now()->addMonths(1),
                'paid_at' => null,
                'status' => 'pending',
                'transaction_id' => null,
            ]);

            Installment::create([
                'payment_id' => $payment->id,
                'amount' => $payment->amount / 2,
                'due_date' => now()->addMonths(2),
                'paid_at' => null,
                'status' => 'pending',
                'transaction_id' => null,
            ]);
        }
    }
}

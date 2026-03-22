<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Invoice;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = Invoice::limit(5)->get();
        if ($invoices->isEmpty()) return;

        foreach ($invoices as $invoice) {
            Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $invoice->amount,
                'method' => ['sslcommerz', 'bkash', 'nagad', 'card'][rand(0, 3)],
                'transaction_id' => 'TXN-' . rand(1000000, 9999999),
                'status' => 'paid',
            ]);
            $invoice->update(['status' => 'paid']);
        }
    }
}

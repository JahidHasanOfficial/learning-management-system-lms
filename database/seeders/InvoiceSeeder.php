<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\User;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::role('student')->get();
        if ($students->isEmpty()) {
            $students = User::take(5)->get();
        }

        foreach ($students as $student) {
            Invoice::create([
                'user_id' => $student->id,
                'order_id' => rand(1000, 9999),
                'amount' => 500.00,
                'status' => 'pending',
                'invoice_no' => 'INV-' . rand(100000, 999999),
            ]);
        }
    }
}

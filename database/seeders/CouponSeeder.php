<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create([
            'code' => 'WELCOME50',
            'type' => 'percentage',
            'value' => 50,
            'expire_at' => now()->addMonths(1),
            'status' => 'active',
        ]);

        Coupon::create([
            'code' => 'SAVE100',
            'type' => 'fixed',
            'value' => 100,
            'expire_at' => now()->addMonths(2),
            'status' => 'active',
        ]);
    }
}

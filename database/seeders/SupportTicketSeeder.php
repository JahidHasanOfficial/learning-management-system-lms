<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupportTicket;
use App\Models\User;

class SupportTicketSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::role('student')->get();
        if ($students->isEmpty()) {
            $students = User::all()->take(5);
        }

        foreach ($students as $student) {
            SupportTicket::create([
                'user_id' => $student->id,
                'subject' => 'Help with ' . ['Course Access', 'Login Issue', 'Payment Problem'][rand(0, 2)],
                'priority' => ['low', 'medium', 'high'][rand(0, 2)],
                'status' => 'open',
            ]);
        }
    }
}

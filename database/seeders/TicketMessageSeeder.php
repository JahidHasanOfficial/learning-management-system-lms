<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketMessage;
use App\Models\SupportTicket;
use App\Models\User;

class TicketMessageSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = SupportTicket::all();
        if ($tickets->isEmpty()) return;

        foreach ($tickets as $ticket) {
            TicketMessage::create([
                'support_ticket_id' => $ticket->id,
                'user_id' => $ticket->user_id,
                'message' => 'Hello, I need help with ' . $ticket->subject,
            ]);

            $staff = User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->first();
            if ($staff) {
                TicketMessage::create([
                    'support_ticket_id' => $ticket->id,
                    'user_id' => $staff->id,
                    'message' => 'Sure, we are looking into it. Please wait.',
                ]);
            }
        }
    }
}

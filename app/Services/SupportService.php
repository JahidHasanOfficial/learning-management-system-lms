<?php

namespace App\Services;

use App\Models\SupportTicket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Storage;

class SupportService
{
    /**
     * Create a new support ticket.
     */
    public function createTicket($userId, $subject, $category, $priority, $message, $attachment = null)
    {
        $ticket = SupportTicket::create([
            'user_id' => $userId,
            'subject' => $subject,
            'category' => $category,
            'priority' => $priority,
            'status' => 'open'
        ]);

        $this->addMessage($ticket->id, $userId, $message, $attachment);

        return $ticket;
    }

    /**
     * Add message to a ticket.
     */
    public function addMessage($ticketId, $userId, $message, $attachment = null)
    {
        $path = null;
        if ($attachment) {
            $path = $attachment->store('tickets/attachments', 'public');
        }

        return TicketMessage::create([
            'support_ticket_id' => $ticketId,
            'user_id' => $userId,
            'message' => $message,
            'attachment_path' => $path
        ]);
    }

    /**
     * Close a ticket.
     */
    public function closeTicket($ticketId)
    {
        $ticket = SupportTicket::findOrFail($ticketId);
        $ticket->update(['status' => 'closed']);
        return $ticket;
    }
}

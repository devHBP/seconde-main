<?php

namespace App\Mail;

use App\Models\TicketReprise;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Milon\Barcode\DNS1D;

class TicketRepriseMail extends Mailable
{
    use Queueable, SerializesModels;


    public TicketReprise $ticket;
    public string $barcode;

    /**
     * Create a new message instance.
     */
    public function __construct(TicketReprise $ticket)
    {
        $this->ticket = $ticket;
        $barcodeGenerator = new DNS1D();
        $this->barcode = $barcodeGenerator->getBarcodePNG($ticket->uuid, 'C128', 2, 70);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre Ticket de Reprise',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket_reprise',
            with:([
                'ticket' => $this->ticket,
                'barcode' => $this->barcode,
            ]),
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

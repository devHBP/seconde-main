<?php

namespace App\Mail;

use App\Models\TicketReprise;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketRepriseMail extends Mailable
{
    use Queueable, SerializesModels;


    public TicketReprise $ticket;
    public $barcode;
    public $filename;

    /**
     * Create a new message instance.
     */
    public function __construct(TicketReprise $ticket, $barcode, $filename)
    {
        $this->ticket = $ticket;
        $this->barcode = $barcode;
        $this->filename = $filename;
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
        return [
            // Attachment::fromData(
            //     fn() => $this->barcode,
            //     $this->filename
            // )->withMime('image/png')
        ];
    }
}

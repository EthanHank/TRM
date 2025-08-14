<?php

namespace App\Mail;

use App\Models\Drying;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DryingStarted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $drying;

    /**
     * Create a new message instance.
     */
    public function __construct(Drying $drying)
    {
        $this->drying = $drying;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Drying Started',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.dryings.started',
            with: [
                'drying' => $this->drying
            ]
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

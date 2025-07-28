<?php

namespace App\Mail;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    public $user;

    public $cancelReason;

    /**
     * Create a new message instance.
     */
    public function __construct(int $appointmentId, int $userId, string $cancelReason)
    {
        $this->appointment = Appointment::with(['appointment_type', 'paddy.paddy_type'])->findOrFail($appointmentId);
        $this->user = User::findOrFail($userId);
        $this->cancelReason = $cancelReason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Cancelled',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.appointment.cancelled',
            with: [
                'appointment' => $this->appointment,
                'user' => $this->user,
                'cancelReason' => $this->cancelReason,
            ],
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

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmationEmail extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $project;
    public $reservation;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($reservation , $project, $user)
    {
        $this->reservation = $reservation;
        $this->project = $project;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('mail.reservation_confirmation_subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.reservation.confirmation',
            with: [
                'reservation' => $this->reservation,
                'user' => $this->user,
                'projectImage' => $this->project->getFirstMediaUrl('thumbnail'),
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

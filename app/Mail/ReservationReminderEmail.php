<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationReminderEmail extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The reservation instance.
     *
     * @var \App\Models\Reservation
     */
    public Reservation $reservation;

    /**
     * The project instance.
     *
     * @var \App\Models\Project
     */
    public $project;



    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
        $this->project = $reservation->project;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('mail.reservation_reminder_subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.reservation.reminder',
            with: [
                'reservation' => $this->reservation,
                'user' => $this->reservation->customer,
                'projectImage' => $this->project->getFirstMediaUrl('thumbnail'),
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

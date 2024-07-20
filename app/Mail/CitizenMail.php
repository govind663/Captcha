<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CitizenMail extends Mailable
{
    use Queueable, SerializesModels;
    public $citizenDetails;

    /**
     * Create a new message instance.
     */
    public function __construct($citizenDetails)
    {
        $this->citizenDetails = $citizenDetails;

        // Debugging
        Log::info('Citizen Details:', $citizenDetails);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Login Credentials',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // === How to passed $citizenDetails
            view: 'mail.citizen-mailer',
            with: ['citizenDetails' => $this->citizenDetails],
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

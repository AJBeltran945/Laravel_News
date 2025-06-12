<?php

namespace App\Mail;

use App\Models\FooterContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class FooterContactReceived extends Mailable
{
    use Queueable, SerializesModels;

    public FooterContact $contact;

    /**
     * Inject the Eloquent model instead of an array
     */
    public function __construct(FooterContact $contact)
    {
        $this->contact = $contact;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo mensaje desde el formulario del footer'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'frontend.emails.footer-contact',
            with: [
                'contact' => $this->contact,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use App\Core\ServiceUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class ContactMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $contactData)
    {
       $this->afterCommit();
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
            return new Envelope(
                from:new Address(env("SUPPORT_MAIL_USERNAME"),config('app.name')),
                subject: ServiceUtils::ucfirst_lower($this->contactData['name']).', Demande support -' .config('app.name'),
                replyTo: [
                    new Address($this->contactData['email'], $this->contactData['name']),
                ],
            );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.contactForm',
            with:[
                "message" => $this->contactData['message']
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

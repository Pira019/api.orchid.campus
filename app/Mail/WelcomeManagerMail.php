<?php

namespace App\Mail;

use App\Core\ServiceUtils;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeManagerMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $userFirstName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $user)
    {
        $this->afterCommit();

        $this->userFirstName = ServiceUtils::ucfirst_lower($this->user->customer->first_name);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from:new Address(env("WELCOME_MAIL_USERNAME"),config('app.name')),
            subject: $this->userFirstName.', Bienvenue dans l\'équipe - '.config('app.name') ,
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
            markdown: 'emails.manager.welcome',
            with:[
                'name' => $this->userFirstName,
                //userName is unique id with wich manager or admin use to log in
                'userName' => $this->user->user_name,
                'urlToconnect' => env('SPA_URL')."/manager/mot-de-passe-oublie",
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

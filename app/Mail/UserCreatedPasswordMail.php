<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCreatedPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $token = null;
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this
            ->subject('Set Up Your Password (ZiPS)')
            ->view('mail.send-password-link')
            ->with([
                'url' => url("http://41.59.105.130:8080/password/reset/{$this->token}"),
                'name' => $this->user->name
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to the User Created Password Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    //    public function content(): Content
    //    {
    //        return new Content(
    //            view: 'view.name',
    //        );
    //    }

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

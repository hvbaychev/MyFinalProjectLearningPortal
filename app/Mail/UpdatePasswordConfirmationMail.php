<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class UpdatePasswordConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $config;
    protected $loginLink;

    public function __construct($user)
    {
        $this->user = $user;
        $this->config = Config::get('mail.email_data');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return (new Envelope())
               ->from($this->config['address'], $this->config['name'])
               ->subject($this->config['subject_pass_update']);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $this->loginLink = route('show_form');
        
        return (new Content('email.update_password_confirmation_mail'))
                            ->with(['user_name' => $this->user->first_name,
                                    'loginLink' => $this->loginLink]);
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

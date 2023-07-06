<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $new_user;
    protected $config;
    protected $loginLink;

    public function __construct($new_user)
    {
        $this->new_user = $new_user->first_name;
        $this->config = Config::get('mail.email_data');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return (new Envelope())
               ->from($this->config['address'], $this->config['name'])
               ->subject($this->config['subject_welcome']);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $this->loginLink = route('show_form');
        
        return (new Content('email.welcome_mail'))
                            ->with(['user_name' => $this->new_user,
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

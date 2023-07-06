<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use App\Models\Password_reset;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $user;
    protected $token;
    protected $expires;
    protected $config;
    protected $password_reset;
    protected $resetLink;

    public function __construct($user, $expires = null) {
        $this->user = $user;
        $this->expires = $expires;
        $this->config = Config::get('mail.email_data');
    }

    
     

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return (new Envelope())
               ->from($this->config['address'], $this->config['name'])
               ->subject($this->config['subject_pass_reset']);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {        
        $this->password_reset = Password_reset::where('email', $this->user->email)
        ->latest('created_at')
        ->first();

        if(isset($this->password_reset)) {
            $this->token = $this->password_reset->token;
            $this->resetLink = route('reset_password', ['token' => $this->token]);
        } else {
            $this->token = null;
            $loginLink = route('show_form');
            return (new Content('email.something_went_wrong'))
                                ->with(['user_name' => $this->user->first_name,
                                'loginLink' => $loginLink]);
        }


        return (new Content('email.reset_password_mail'))
                            ->with(['user_name' => $this->user->first_name,
                                    'expires' => $this->expires,
                                    'resetLink' => $this->resetLink]);
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

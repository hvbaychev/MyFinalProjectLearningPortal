<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class CourseApplyRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $config;
    protected $courseLink;
    protected $course;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $course)
    {
        $this->user = $user;
        $this->config = Config::get('mail.email_data');
        $this->course = $course;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return (new Envelope())
               ->from($this->config['address'], $this->config['name'])
               ->subject($this->config['subject_course_applied_confirmation']);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $this->courseLink = route('course.show', ['course' => $this->course->id]);
        
        return (new Content('email.course_application_mail'))
                            ->with(['user_name' => $this->user->first_name,
                                    'courseLink' => $this->courseLink,
                                    'course' => $this->course->name]);
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

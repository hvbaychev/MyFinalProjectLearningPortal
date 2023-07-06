<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use App\Models\Course;

class CourseApplicationApprovedMail extends Mailable
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
               ->subject($this->config['subject_course_application_approved_confirmation']);

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $course_name = Course::find($this->course);
        $this->courseLink = route('course.show', ['course' => $this->course->id]);
        
        return (new Content('email.cource_application_approved_mail'))
                                                    ->with(['user_name' => $this->user->first_name,
                                                    'courseLink' => $this->courseLink,
                                                    'course' => $course_name->name]);

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
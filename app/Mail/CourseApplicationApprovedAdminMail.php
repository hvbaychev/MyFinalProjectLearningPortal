<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use App\Models\Course;

class CourseApplicationApprovedAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_applied;
    protected $config;
    protected $courseLink;
    protected $userAppliedLink;
    protected $course;


    /**
     * Create a new message instance.
     */
    public function __construct($user, $course)
    {
        $this->user_applied = $user;
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
               ->subject($this->config['subject_course_applied_confirmation_admin']);

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        
        $this->courseLink = route('course.show', ['course' => $this->course]);
        $this->userAppliedLink = route('user.show', ['user' => $this->user_applied->id]);
        
        $course_name = Course::find($this->course);

        return (new Content('email.course_application_approved_admin_notify'))
                            ->with(['user_name' => $this->user_applied->first_name,
                                    'user_email' => $this->user_applied->email,
                                    'courseLink' => $this->courseLink,
                                    'userLink' => $this->userAppliedLink,
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

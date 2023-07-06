<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use App\Models\User;

class CourseApplyRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $user_applied;
    protected $users_admin;
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
        $this->users_admin = User::where('user_type', 'admin')->get('email');
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
               ->subject($this->config['subject_course_applied_notification_admin'])
               ->cc($this->users_admin->pluck('email')->toArray()); 
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $this->courseLink = route('course.show', ['course' => $this->course->id]);
        $this->userAppliedLink = route('user.show', ['user' => $this->user_applied->id]);
        
        return (new Content('email.course_application_admin_notify_mail'))
                            ->with(['user_name' => $this->user_applied->first_name,
                                    'user_email' => $this->user_applied->email,
                                    'courseLink' => $this->courseLink,
                                    'userLink' => $this->userAppliedLink,
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

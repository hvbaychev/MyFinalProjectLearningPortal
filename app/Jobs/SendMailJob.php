<?php

namespace App\Jobs;

use App\Mail\CourseApplyApprovedAdminMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ResetPasswordConfirmationMail;
use App\Mail\UpdateEmailConfirmationMail;
use App\Mail\UpdateEmailMail;
use App\Mail\UpdatePasswordConfirmationMail;
use App\Mail\WelcomeMail;
use App\Mail\ResetPasswordMail;
use App\Mail\CourseApplyRequestMail;
use App\Mail\CourseApplyRequestAdminMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;
use App\Models\User;
use App\Models\UserType;
use Exception;
use App\Models\Course;
use App\Mail\CourseApplicationApprovedMail;
use App\Mail\CourseApplicationApprovedAdminMail;


class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $user;
    public $email_type;
    public $expires;
    public $course;
    
    public function __construct($user, $email_type, $expires = null, $course = null)
    {
        $this->user = $user;
        $this->email_type = $email_type;
        $this->expires = $expires;
        $this->course = $course;
    }

    public function handle(): void
    {

        Log::debug('Sending ' . $this->email_type . ' email to: ' . $this->user->email);

        $email_class = $this->getMailClass($this->email_type);
        
        if(!is_null($this->expires)) {
            $mail = new $email_class($this->user, $this->expires);
        } 
        
        if(!is_null($this->course)) {

            
            // $course = Course::find($this->course);
            $mail = new $email_class($this->user, $this->course);
        
        } else {
            $mail = new $email_class($this->user);
        }

        
        $mail->with([
            'trans' => function ($key, $replace = [], $locale = null) {
                return Lang::trans($key, $replace, $locale);
            }
        ]);


        try {

            if($this->email_type == 'course_enrollment_admin_notify' || $this->email_type == 'course_enrollment_confirmation_admin_notify') {
                
                $this->user = User::where('user_type', UserType::ADMIN_CODE)->pluck('email');
                
                $admin_emails = User::where('user_type', 'admin')->pluck('email')->unique();

                
                foreach($admin_emails as $admin) {
                    Mail::to($admin)->send($mail);
                }
                
                
            } else {

                Mail::to($this->user->email)->send($mail);
            }
        } catch (Exception $e) {
            Log::error('Failed to send email to: ' . $this->user);
        }
    }
    
    protected function getMailClass($email_type) {
        switch($email_type) {
            case 'registration':
                return WelcomeMail::class;
            case 'reset_password':
                return ResetPasswordMail::class;
            case 'reset_password_confirmation':
                return ResetPasswordConfirmationMail::class;
            case 'update_password_confirmation':
                return UpdatePasswordConfirmationMail::class;
            case 'update_email':
                return UpdateEmailMail::class;
            case 'update_email_confirmation':
                return UpdateEmailConfirmationMail::class;
            case 'course_enrollment_application':
                return CourseApplyRequestMail::class;
            case 'course_enrollment_admin_notify':
                return CourseApplyRequestAdminMail::class;
            case 'course_enrollment_application_approved':
                return CourseApplicationApprovedMail::class;
            case 'course_enrollment_confirmation_admin_notify':
                return CourseApplicationApprovedAdminMail::class;
            default:
                return null;
        }
    }
}

<div>
    <p>
        {{ trans('mail.sent_at') }} {{ now()->format('H:i, d.m.Y') }} <br><br>

        {{ trans('mail.greeting_admin') }} <br><br>

    
        {{ trans('mail.course_enrollment_confirmation_admin_body', ['user_name' => $user_name, 'user_email' => $user_email, 'course' => $course]) }} <br><br>

        <a href="{{ $userLink }}">{{ trans('mail.course_enrollment_application_admin_user_link') }}</a> <br>
        <a href="{{ $courseLink }}">{{ trans('mail.cours_enrollment_application_admin_course_link') }}</a>

    </p>
</div>
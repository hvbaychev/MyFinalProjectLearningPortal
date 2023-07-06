<div>
    <p>
        {{ trans('mail.sent_at') }} {{ now()->format('H:i, d.m.Y') }} <br><br>

        {{ trans('mail.greeting', ['user_name' => $user_name]) }} <br><br>

    
        {{ trans('mail.course_enrollment_approved_body', ['course' => $course]) }} <br><br>

        <a href="{{ $courseLink }}">{{ trans('mail.course_enrollment_approved_link') }}</a>

    </p>
</div>
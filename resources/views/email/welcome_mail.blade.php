<div>
    <p>
        {{ trans('mail.sent_at') }} {{ now()->format('H:i, d.m.Y') }} <br><br>

        {{ trans('mail.greeting', ['user_name' => $user_name]) }} <br><br>

    
        {{ trans('mail.greeting_body') }} LearningPortal! <br><br>

        <a href="{{ $loginLink }}">{{ trans('mail.login_link') }}</a>

    </p>
</div>
<div>
    <p>
        {{ trans('mail.sent_at') }} {{ now()->format('H:i, d.m.Y') }} <br><br>

        {{ trans('mail.greeting', ['user_name' => $user_name]) }}<br><br>
        
        {{ trans('mail.update_email_confirmation_body') }} <br><br>
    </p>
</div>

<a href="{{ $loginLink }}">{{ trans('mail.update_email_confirmation_link') }}</a>
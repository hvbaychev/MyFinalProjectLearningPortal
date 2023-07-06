<div>
    <p>
        {{ trans('mail.sent_at') }} {{ now()->format('H:i, d.m.Y') }} <br><br>

        {{ trans('mail.greeting', ['user_name' => $user_name]) }} <br><br>

        {{ trans('mail.reset_password_body', ['expires' => $expires]) }} <br><br>
    </p>
</div>

<a href="{{ $resetLink }}">{{ trans('mail.reset_password_link') }}</a>

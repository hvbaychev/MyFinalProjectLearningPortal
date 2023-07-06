<div>
    <p>

        {{ trans('mail.sent_at') }} {{ now()->format('H:i, d.m.Y') }} <br><br>

        {{ trans('mail.greeting', ['user_name' => $user_name]) }}, <br><br>

        {{ trans('mail.update_email_body') }}<br><br>
    </p>
</div>

<a href="{{ $updateMailLink }}">{{ trans('mail.update_email_link') }}</a>

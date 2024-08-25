@component('mail::message')
    {!! $mailData['body'] !!}

    Thanks,
    {{ config('app.name') }}
@endcomponent

@component('mail::message')

You have received a new email from the Contact Us page in unlockplcexpert.com:

<div>Name: {!! $mailData['name'] !!}</div>
<div>Email: {!! $mailData['email'] !!}</div>
<div>mobile:{!! $mailData['dial_code'] !!}{!! $mailData['mobile'] !!}</div>
<div>Country name: {!! $mailData['country_name'] !!}</div>
<hr>
<div>Subject: {!! $mailData['subject'] !!}</div>
<div>Message: {!! $mailData['message'] !!}</div>
<hr>

    Thanks,
    {{ config('app.name') }}
@endcomponent

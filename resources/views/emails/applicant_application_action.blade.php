@component('mail::message')
Hello {{ $applicant->name }},

I just want to inform you that your application for <a href="{{ route('show', ['job' => $applicant->job?->uuid]) }}">{{ $applicant->job?->title }}</a>
has been {{ $status }} and
@if ($approved)
please wait for futher instruction, I will contact you as soon as possible regarding the hiring process.
@else
we decided that we will not continue with your application, thank you for the interest and good luck with your job hunting!
@endif

Kind regards,<br>
{{ $applicant->job?->user?->name }}
@endcomponent

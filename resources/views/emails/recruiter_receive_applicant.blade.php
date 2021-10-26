@component('mail::message')
Dear {{ $applicant->job?->user?->name }},

The applicant {{ $applicant->name }} has applied for <a href="{{ route('show', ['job' => $applicant->job?->uuid]) }}">{{ $applicant->job?->title }}</a>
to work in {{ ucfirst($applicant->job?->environment) }} and {{ ucfirst($applicant->job?->type) }} position.

Don't forget to take an action so the applicant will be notified.

Kind regards,<br>
{{ config('app.name') }}
@endcomponent

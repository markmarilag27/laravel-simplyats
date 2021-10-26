@component('mail::message')
Hello {{ $applicant->name }},

We received your application for <a href="{{ route('show', ['job' => $applicant->job?->uuid]) }}">{{ $applicant->job?->title }}</a>
to work as {{ ucfirst($applicant->job?->environment) }} for {{ ucfirst($applicant->job?->type) }} position.

If you have any question feel free to send me an email <a href="mailto:{{ $applicant->job?->user?->email }}">{{ $applicant->job?->user?->email }}</a>

Kind Regards,<br>
{{ $applicant->job?->user?->name }}
@endcomponent

@extends('layouts.app')

{{-- title --}}
@push('title') {{ $job->title }} @endpush

@section('content')
<div class="w-full max-w-screen-sm mx-auto py-4 flex justify-between items-center">
    <a href="{{ route('index') }}">Back to home</a>
    {{-- end back to home --}}
    <a href="{{ route('show', ['job' => $job->uuid]) }}" class="appearance-none block border rounded px-6 py-2 bg-gray-500 text-white hover:bg-gray-600">Read Job Description</a>
</div>
{{-- end actions --}}

@include('forms.applicant', ['job' => $job])
{{-- end applicant form --}}
@endsection

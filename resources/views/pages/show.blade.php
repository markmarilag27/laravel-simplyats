@extends('layouts.app')

{{-- title --}}
@push('title') {{ $job->title }} @endpush

@push('head_style')
    <link href="{{ asset('css/markdown.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="w-full max-w-screen-sm mx-auto bg-white p-4 shadow rounded">
    <h1 class="text-xl">{{ $job->title }}</h1>
    {{-- end title --}}
    <div class="text-sm text-gray-400 py-1">Location: {{ $job->location }} | Type: {{ ucfirst($job->type) }} | Environment: {{ ucfirst($job->environment) }}</div>
    {{-- end info --}}
    <div class="markdown-body border-box py-4">{!! $job->description !!}</div>
    {{-- end markdown --}}
    <div class="text-sm text-gray-500 py-1">Posted by: {{ $job?->user?->name }}</div>
    {{-- end author --}}
    <div class="text-sm text-gray-500 py-1">Posted: {{ $job->created_at->diffForHumans() }}</div>
    {{-- end posted at --}}
</div>
{{-- end content --}}

<div class="w-full max-w-screen-sm mx-auto py-4 flex justify-between items-center">
    <a href="{{ route('index') }}">Back to home</a>
    {{-- end back to home --}}
    <a href="{{ route('apply', ['job' => $job->uuid]) }}" class="appearance-none block border rounded px-6 py-2 bg-gray-500 text-white hover:bg-gray-600">Apply to this job</a>
</div>
{{-- end actions --}}
@endsection

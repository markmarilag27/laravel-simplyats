@extends('layouts.app')

{{-- title --}}
@push('title') A Web Developers Job Seeker Section @endpush

@section('content')
<div class="w-full max-w-screen-sm mx-auto py-4">
    Total Jobs: {{ number_format($total) }}
</div>
{{-- end total --}}

<div class="w-full max-w-screen-sm mx-auto mb-6">
    @include('forms.search_main')
</div>
{{-- end search --}}

<div class="w-full max-w-screen-sm mx-auto bg-white py-2 shadow rounded">
    @foreach ($collection as $job)
    <a href="{{ route('show', ['job' => $job->uuid]) }}" class="block w-full py-2 px-4 hover:bg-gray-50">
        <div class="text-gray-500">{{ $job->title }}</div>
        {{-- end title --}}
        <div class="text-sm text-gray-400 py-1">Location: {{ $job->location }} | Type: {{ ucfirst($job->type) }} | Environment: {{ ucfirst($job->environment) }}</div>
        <div class="text-xs text-gray-400 font-bold py-2">Posted: {{ $job->created_at->diffForHumans() }}</div>
    </a>
    @endforeach
</div>
{{-- end content --}}

<div class="w-full max-w-screen-sm mx-auto my-6">
    {{ $collection->links() }}
</div>
{{-- end paginator --}}
@endsection

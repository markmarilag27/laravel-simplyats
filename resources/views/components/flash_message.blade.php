@if ($message = session('success'))
<div id="flash-message" class="fixed bottom-0 right-0 mr-6 mb-6 z-50">
    <div class="bg-green-400 py-3 px-6 text-white rounded">
        {{ $message }}
    </div>
</div>
@endif

@if ($message = session('error'))
<div id="flash-message" class="fixed bottom-0 right-0 mr-6 mb-6 z-50">
    <div class="bg-red-500 py-3 px-6 text-white rounded">
        {{ $message }}
    </div>
</div>
@endif

@if ($message = session('info'))
<div id="flash-message" class="fixed bottom-0 right-0 mr-6 mb-6 z-50">
    <div class="bg-blue-400 py-3 px-6 text-white rounded">
        {{ $message }}
    </div>
</div>
@endif

@if ($message = session('warning'))
<div id="flash-message" class="fixed bottom-0 right-0 mr-6 mb-6 z-50">
    <div class="bg-yellow-400 py-3 px-6 text-white rounded">
        {{ $message }}
    </div>
</div>
@endif


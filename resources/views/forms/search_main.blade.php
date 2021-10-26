<form id="search-main" method="GET">
    <div class="flex flex-wrap gap-4">
        <input
            type="text"
            class="appearance-none outline-none border rounded py-2 px-4 flex-grow"
            id="title"
            name="title"
            placeholder="Type in job title..."
        >
        {{-- end input --}}
        <button type="submit" id="seach-main-btn" class="appearance-none outline-none border rounded px-6 py-2 bg-gray-500 text-white hover:bg-gray-600">
            Search
        </button>
    </div>
    {{-- end flex --}}
</form>
{{-- end search main --}}

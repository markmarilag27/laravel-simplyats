<form id="applicant-form" method="POST" action="{{ route('apply', ['job' => $job->uuid]) }}" enctype="multipart/form-data" class="w-full max-w-screen-sm mx-auto bg-white p-6 shadow rounded">
    @csrf
    {{-- end csrf --}}
    <input type="hidden" name="job_id" value="{{ $job->id }}">
    {{-- end job id --}}
    <div class="flex flex-wrap gap-4 mb-4">
        <div class="flex-1">
            <label for="first_name" class="text-xs uppercase font-bold text-gray-500">First Name</label>
            <input type="text" id="first_name" name="first_name" class="appearance-none outline-none w-full border rounded py-2 px-4 my-2" placeholder="Type in..." required>
        </div>
        {{-- end col --}}
        <div class="flex-1">
            <label for="last_name" class="text-xs uppercase font-bold text-gray-500">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="appearance-none outline-none w-half border rounded py-2 px-4 my-2" placeholder="Type in..." required>
        </div>
        {{-- end col --}}
        <div class="flex-grow">
            <label for="location" class="text-xs uppercase font-bold text-gray-500">Location</label>
            <input type="text" id="location" name="location" class="appearance-none outline-none w-full border rounded py-2 px-4 my-2" placeholder="Type in..." required>
        </div>
        {{-- end col --}}
        <div class="flex-grow">
            <label for="email" class="text-xs uppercase font-bold text-gray-500">Email</label>
            <input type="email" id="email" name="email" class="appearance-none outline-none w-full border rounded py-2 px-4 my-2" placeholder="Type in..." required>
        </div>
        {{-- end col --}}
        <div class="flex-grow">
            <label for="phone" class="text-xs uppercase font-bold text-gray-500">Contact Number</label>
            <input type="text" id="phone" name="phone" class="appearance-none outline-none w-full border rounded py-2 px-4 my-2" maxlength="12" minlength="9" placeholder="Type in..." required>
        </div>
        {{-- end col --}}
        <div class="flex-grow">
            <label for="cv" class="text-xs uppercase font-bold text-gray-500">Upload CV</label>
            <input type="file" id="cv" name="cv" class="appearance-none outline-none w-full border rounded py-2 px-4 my-2" accept="application/msword, application/pdf, image/jpg, image/jpeg, image/png" placeholder="Type in..." required>
        </div>
        {{-- end col --}}
    </div>
    {{-- end flex --}}
    <button type="submit" class="appearance-none block w-full border rounded px-6 py-4 font-bold bg-black text-white">Submit Application</button>
    {{-- end submit button --}}
</form>

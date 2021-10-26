<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\JobApplicationAppliedAction;
use App\Http\Requests\JobApplicationRequest;
use App\Models\Job;

class JobApplicationController extends Controller
{
    /**
     * Create a new JobApplicationController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    #[Route("/{job:uuid}/apply", methods: ["GET"])]
    public function show(Job $job): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('pages.apply', ['job' => $job->load('user')]);
    }

    #[Route("/{job:uuid}/apply", methods: ["POST"])]
    public function store(JobApplicationRequest $request, JobApplicationAppliedAction $action): \Illuminate\Http\RedirectResponse
    {
        // Get the validated data from the request/
        $payload = $request->validated();

        // Execute the job application applied action
        $action->execute($payload);

        /** @var $uuid */
        $uuid = explode('/', $request->path())[0];

        return redirect()
            ->route('show', ['job' => $uuid])
            ->with(['success' => trans('applicant.applied_success')]);
    }
}

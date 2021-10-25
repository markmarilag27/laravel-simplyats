<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\JobRequest;
use App\Http\Resources\API\JobResource;
use App\Models\Job;

class JobUpdateController extends Controller
{
    /**
     * Create a new JobUpdateController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:100,1']);
    }

    #[Route("/api/jobs/{job:uuid}", methods: ["PUT"])]
    public function __invoke(JobRequest $request, Job $job): JobResource
    {
        // Get the validated data from the request
        $payload = $request->validated();

        // Update the job
        $job->update($payload);

        return new JobResource($job->load('user'));
    }
}

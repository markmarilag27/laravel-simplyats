<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\JobStoreRequest;
use App\Http\Resources\API\JobResource;
use App\Models\Job;

class JobStoreController extends Controller
{
    /**
     * Create a new JobStoreController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:100,1']);
    }

    #[Route("/api/jobs", methods: ["POST"])]
    public function __invoke(JobStoreRequest $request): JobResource
    {
        // Get the validated data from the request
        $payload = $request->validated();

        /** @var $userId */
        $userId = $request->user()->id;

        // Add up to payload
        $payload['user_id'] = $userId;

        /** @var $job */
        $job = Job::create($payload);

        return new JobResource($job->load('user'));
    }
}

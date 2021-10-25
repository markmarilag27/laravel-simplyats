<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobShowController extends Controller
{
    /**
     * Create a new JobShowController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:60,1']);
    }

    #[Route("/api/jobs/{job:uuid}", methods: ["GET"])]
    public function __invoke(Request $request, Job $job): JobResource
    {
        return new JobResource($job->load('user'));
    }
}

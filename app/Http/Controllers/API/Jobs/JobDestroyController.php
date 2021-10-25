<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobDestroyController extends Controller
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

    #[Route("/api/jobs/{job:uuid}", methods: ["DELETE"])]
    public function __invoke(Request $request, Job $job): \Illuminate\Http\Response
    {
        $job->delete();

        return response()->noContent();
    }
}

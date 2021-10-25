<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\JobResource;
use App\Models\Job;
use Illuminate\Http\Request;

class JobIndexController extends Controller
{
    /**
     * Create a new JobIndexController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:100,1']);
    }

    #[Route("/api/jobs", methods: ["GET"])]
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        /** @var $collection */
        $collection = Job::query()
            ->with('user')
            ->simplePaginate($request->per_page);

        return JobResource::collection($collection);
    }
}

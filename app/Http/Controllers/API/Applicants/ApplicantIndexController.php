<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Applicants;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\ApplicantResource;
use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantIndexController extends Controller
{
    /**
     * Create a new ApplicantIndexController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:100,1']);
    }

    #[Route("/api/applicants", methods: ["GET"])]
    public function __invoke(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        /** @var $collection */
        $collection = Applicant::query()
            ->with('job')
            ->hasFiltered()
            ->latest('id')
            ->simplePaginate($request->per_page);

        return ApplicantResource::collection($collection);
    }
}

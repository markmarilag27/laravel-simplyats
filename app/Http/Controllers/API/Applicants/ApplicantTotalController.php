<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Applicants;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantTotalController extends Controller
{
    /**
     * Create a new ApplicantTotalController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:100,1']);
    }

    #[Route("/api/applicants", methods: ["GET"])]
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        /** @var $collection */
        $collection = Applicant::query()
            ->selectRaw("COUNT(*) AS total")
            ->selectRaw("COUNT(CASE WHEN status IS NULL THEN 1 END) AS action_required")
            ->selectRaw("COUNT(CASE WHEN status = 'approve' THEN 1 END) AS approved")
            ->selectRaw("COUNT(CASE WHEN status = 'reject' THEN 1 END) AS rejected")
            ->first();

        return response()->json(['data' => $collection]);
    }
}

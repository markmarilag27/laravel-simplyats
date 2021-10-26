<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Applicants;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ApplicantApplicationActionRequest;
use App\Http\Resources\API\ApplicantResource;
use App\Mail\ApplicantApplicationActionMail;
use App\Models\Applicant;
use Illuminate\Support\Facades\Mail;

class ApplicantApplicationActionController extends Controller
{
    /**
     * Create a new ApplicantApplicationActionController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:60,1']);
    }

    #[Route("/api/applicants/{applicant:uuid}/action", methods: ["POST"])]
    public function __invoke(ApplicantApplicationActionRequest $request, Applicant $applicant): ApplicantResource
    {
        // Get the validated data from the request
        $payload = $request->validated();

        // Update applicant record
        $applicant->update($payload);

        // Load relationship
        $applicant->load('job.user');

        // Send email to the applicant
        Mail::to($applicant)->send(new ApplicantApplicationActionMail($applicant, $payload['status']));

        return new ApplicantResource($applicant);
    }
}

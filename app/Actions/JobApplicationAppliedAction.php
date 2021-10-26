<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\MediaCollection;
use App\Mail\ApplicantAppliedMail;
use App\Mail\RecruiterReceiveApplicantMail;
use App\Models\Applicant;
use Illuminate\Support\Facades\Mail;

class JobApplicationAppliedAction
{
    /**
     * @param $payload
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function execute($payload): void
    {
        /** @var $file */
        $file = $payload[MediaCollection::CV];
        // unset the cv file
        unset($payload[MediaCollection::CV]);

        /** @var $applicant */
        $applicant = Applicant::firstOrCreate($payload);

        // Add the cv file
        $this->addFile($applicant, $file);

        // Load relationship
        $applicant->load('job.user');

        // Send email to the applicant
        Mail::to($applicant)->send(new ApplicantAppliedMail($applicant));

        // Send email to the recruiter
        Mail::to($applicant->job?->user)->send(new RecruiterReceiveApplicantMail($applicant));
    }

    /**
     * @param Applicant $applicant
     * @param $file
     * @return void
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    private function addFile(Applicant $applicant, $file): void
    {
        $applicant->addMedia($file)
            ->toMediaCollection(MediaCollection::CV);
    }
}

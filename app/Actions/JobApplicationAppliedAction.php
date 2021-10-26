<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\MediaCollection;
use App\Models\Applicant;

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

        $this->addFile($applicant, $file);
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

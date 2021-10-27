<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\MediaCollection;
use App\Models\Applicant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CVSeeder extends Seeder
{
    /** @var string $sourceUrl */
    private string $sourceUrl = 'http://www.africau.edu/images/default/sample.pdf';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Set the memory limit to 1024M, adjust base on your needs
        ini_set('memory_limit', '1024M');

        // By default, Laravel keeps a log in memory of all queries that have been run for the current request.
        // However, in some cases, such as when inserting a large number of rows, this can cause the application to use excess memory.
        DB::disableQueryLog();

        $this->command->info('Initializing CVSeeder...');

        /** @var $time_start */
        $time_start = microtime(true);

        // Get all applicants
        Applicant::query()->chunk(1000, function ($applicants) {
            foreach ($applicants as $applicant) {
                if (blank($applicant->curriculumVitae)) {
                    $applicant->addMediaFromUrl($this->sourceUrl)
                        ->toMediaCollection(MediaCollection::CV);
                }
            }
        });

        /** @var $time_end */
        $time_end = microtime(true);

        /** @var $execution_time */
        $execution_time = number_format(($time_end - $time_start), 2);

        $this->command->info("Total execution time: ${execution_time} in seconds.");
    }
}

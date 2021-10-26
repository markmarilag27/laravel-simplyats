<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\ApplicantStatus;
use App\Models\Job;
use Database\Seeders\Traits\HasFaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApplicantSeeder extends Seeder
{
    use HasFaker;

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

        $this->command->info('Initializing ApplicantSeeder...');

        /** @var $time_start */
        $time_start = microtime(true);

        /** @var $rowsNo */
        $rowsNo = 100000;

        /** @var $range */
        $range = range(1, $rowsNo);

        /** @var $chunkSize */
        $chunkSize = 1000;

        // Loop through array chunk
        foreach (array_chunk($range, $chunkSize, true) as $chunk) {
            /** @var $data */
            $data = [];

            /** @var $jobId */
            $jobId = Job::inRandomOrder()->first()->id;

            // Loop chunk
            foreach ($chunk as $index) {
                $data[$index] = [
                    'uuid'          => Str::uuid(),
                    'job_id'        => $jobId,
                    'first_name'    => $this->faker->firstName(),
                    'last_name'     => $this->faker->lastName(),
                    'location'      => $this->faker->country(),
                    'email'         => $this->faker->safeEmail(),
                    'phone'         => $this->faker->phoneNumber(),
                    'status'        => $this->faker->randomElement([null, ...ApplicantStatus::getValues()]),
                    'updated_at'    => now(),
                    'created_at'    => now(),
                ];
            }

            // Insert the applicants
            DB::table('applicants')->insert($data);
        }

        /** @var $time_end */
        $time_end = microtime(true);

        /** @var $execution_time */
        $execution_time = number_format(($time_end - $time_start), 2);

        $this->command->info("Total execution time: ${execution_time} in seconds.");
    }
}

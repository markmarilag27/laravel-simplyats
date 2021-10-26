<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\JobEnvironment;
use App\Enums\JobExperience;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Models\User;
use Database\Seeders\Traits\HasFaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    use HasFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        // Set the memory limit to 1024M, adjust base on your needs
        ini_set('memory_limit', '1024M');

        // By default, Laravel keeps a log in memory of all queries that have been run for the current request.
        // However, in some cases, such as when inserting a large number of rows, this can cause the application to use excess memory.
        DB::disableQueryLog();

        $this->command->info('Initializing JobSeeder...');

        /** @var $userId */
        $userId = User::all()->first()->id;

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

            // Loop chunk
            foreach ($chunk as $index) {
                $data[$index] = [
                    'uuid'          => Str::uuid(),
                    'title'         => $this->faker->jobTitle(),
                    'location'      => $this->faker->country(),
                    'environment'   => $this->faker->randomElement(JobEnvironment::getValues()),
                    'type'          => $this->faker->randomElement(JobType::getValues()),
                    'experience'    => $this->faker->randomElement(JobExperience::getValues()),
                    'description'   => $this->getDescription(),
                    'status'        => $this->faker->randomElement(JobStatus::getValues()),
                    'user_id'       => $userId,
                    'updated_at'    => now(),
                    'created_at'    => now()
                ];
            }

            // Insert the jobs
            DB::table('jobs')->insert($data);
        }

        /** @var $time_end */
        $time_end = microtime(true);

        /** @var $execution_time */
        $execution_time = number_format(($time_end - $time_start), 2);

        $this->command->info("Total execution time: ${execution_time} in seconds.");
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function getDescription(): string
    {
        /** @var $result */
        $result = '';
        /** @var $paragraphs */
        $paragraphs = $this->faker->paragraphs(random_int(2, 6));

        foreach ($paragraphs as $paragraph) {
            $result .= "<p>{$paragraph}</p>";
        }

        return $result;
    }
}

<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\JobEnvironment;
use App\Enums\JobExperience;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'title'         => $this->faker->jobTitle(),
            'location'      => $this->faker->country(),
            'environment'   => $this->faker->randomElement(JobEnvironment::getValues()),
            'type'          => $this->faker->randomElement(JobType::getValues()),
            'experience'    => $this->faker->randomElement(JobExperience::getValues()),
            'description'   => $this->getDescription(),
            'status'        => $this->faker->randomElement(JobStatus::getValues()),
            'user_id'       => User::factory()
        ];
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

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
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->jobTitle(),
            'location'      => $this->faker->country(),
            'environment'   => $this->faker->randomElement(JobEnvironment::getValues()),
            'type'          => $this->faker->randomElement(JobType::getValues()),
            'experience'    => $this->faker->randomElement(JobExperience::getValues()),
            'description'   => $this->faker->randomHtml(),
            'status'        => $this->faker->randomElement(JobStatus::getValues()),
            'user_id'       => User::factory()
        ];
    }
}

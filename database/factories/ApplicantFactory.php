<?php

namespace Database\Factories;

use App\Enums\ApplicantStatus;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Applicant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'job_id'        => Job::factory(),
            'first_name'    => $this->faker->firstName(),
            'last_name'     => $this->faker->lastName(),
            'location'      => $this->faker->country(),
            'email'         => $this->faker->safeEmail(),
            'phone'         => $this->faker->phoneNumber(),
            'status'        => $this->faker->randomElement([null, ...ApplicantStatus::getValues()])
        ];
    }
}

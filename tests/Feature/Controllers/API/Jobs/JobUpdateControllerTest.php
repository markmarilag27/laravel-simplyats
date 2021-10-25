<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Jobs;

use App\Enums\JobStatus;
use App\Http\Controllers\API\Jobs\JobUpdateController;
use App\Models\Job;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JobUpdateControllerTest extends TestCase
{
    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Mock job
        $job = Job::factory()->create();

        // Make sure it's a guest
        $this->assertGuest();

        /** @var $data */
        $data = [];

        $endpoint = action(JobUpdateController::class, ['job' => $job->uuid]);

        // Make the request
        $this->json('PUT', $endpoint, $data)
            ->assertUnauthorized()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_validates_empty_fields(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Mock job
        $job = Job::factory()->create();

        /** @var $data */
        $data = [];

        $endpoint = action(JobUpdateController::class, ['job' => $job->uuid]);

        // Make the request
        $this->json('PUT', $endpoint, $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_returns_job_resource_with_author(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Mock job
        $job = Job::factory()->create(['user_id' => $user->id]);

        /** @var $data */
        $data = [
            'title'         => $job->title,
            'location'      => $job->location,
            'environment'   => $job->environment,
            'type'          => $job->type,
            'experience'    => $job->experience,
            'description'   => $job->description,
            'status'        => $this->faker->randomElement(JobStatus::getValues())
        ];

        $endpoint = action(JobUpdateController::class, ['job' => $job->uuid]);

        // Make the request
        $this->json('PUT', $endpoint, $data)
            ->assertOk()
            ->assertJsonStructure(['data' => [
                'uuid',
                'title',
                'location',
                'environment',
                'type',
                'experience',
                'description',
                'status',
                'author' => [
                    'uuid',
                    'name',
                    'email',
                    'email_verified_at',
                    'updated_at',
                    'created_at'
                ],
                'updated_at',
                'created_at'
            ]]);
    }
}

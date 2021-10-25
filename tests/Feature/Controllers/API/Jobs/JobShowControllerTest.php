<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Jobs;

use App\Http\Controllers\API\Jobs\JobShowController;
use App\Models\Job;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JobShowControllerTest extends TestCase
{
    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Mock job
        $job = Job::factory()->create();

        // Make sure it's a guest
        $this->assertGuest();

        $endpoint = action(JobShowController::class, ['job' => $job->uuid]);

        // Make the request
        $this->json('GET', $endpoint)
            ->assertUnauthorized()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_returns_job_resource_with_author_resource(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Mock job
        $job = Job::factory()->create();

        $endpoint = action(JobShowController::class, ['job' => $job->uuid]);

        // Make the request
        $this->json('GET', $endpoint)
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

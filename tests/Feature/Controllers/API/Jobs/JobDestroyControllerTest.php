<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Jobs;

use App\Http\Controllers\API\Jobs\JobDestroyController;
use App\Models\Job;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JobDestroyControllerTest extends TestCase
{
    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Mock job
        $job = Job::factory()->create();

        // Make sure it's a guest
        $this->assertGuest();

        $endpoint = action(JobDestroyController::class, ['job' => $job->uuid]);

        // Make the request
        $this->json('DELETE', $endpoint)
            ->assertUnauthorized()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_returns_no_content_on_success_delete(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Mock job
        $job = Job::factory()->create();

        $endpoint = action(JobDestroyController::class, ['job' => $job->uuid]);

        // Make the request
        $this->json('DELETE', $endpoint)->assertNoContent();
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Jobs;

use App\Http\Controllers\API\Jobs\JobIndexController;
use App\Models\Job;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JobIndexTest extends TestCase
{
    /** @var string $endpoint */
    protected string $endpoint;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->endpoint = action(JobIndexController::class);
    }

    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        // Make the request
        $this->json('GET', $this->endpoint)
            ->assertUnauthorized()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_returns_job_list_collection(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Mock jobs
        Job::factory()->count(15)->create(['user_id' => $user->id]);

        // Make the request
        $this->json('GET', $this->endpoint)
            ->assertOk()
            ->assertJsonStructure([
                'data',
                'links',
                'meta'
            ]);
    }
}

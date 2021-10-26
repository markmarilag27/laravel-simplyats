<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Applicants;

use App\Http\Controllers\API\Applicants\ApplicantIndexController;
use App\Models\Applicant;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApplicantIndexControllerTest extends TestCase
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

        $this->endpoint = action(ApplicantIndexController::class);
    }

    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        // Mock applicant
        Applicant::factory()->create();

        // Make the request
        $this->json('GET', $this->endpoint)
            ->assertUnauthorized()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_returns_applicant_resource(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Mock applicants
        Applicant::factory()->count(100)->create();

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

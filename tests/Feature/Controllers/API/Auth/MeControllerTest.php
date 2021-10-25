<?php

namespace Tests\Feature\Controllers\API\Auth;

use App\Http\Controllers\API\Auth\MeController;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MeControllerTest extends TestCase
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

        $this->endpoint = action(MeController::class);
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
    public function it_return_user_information(): void
    {
        // Mock authenticated user
        Sanctum::actingAs(User::factory()->create());

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Make the request
        $this->json('GET', $this->endpoint)
            ->assertOk()
            ->assertJsonStructure(['data' => [
                'uuid',
                'email',
                'email_verified_at',
                'updated_at',
                'created_at'
            ]]);
    }
}

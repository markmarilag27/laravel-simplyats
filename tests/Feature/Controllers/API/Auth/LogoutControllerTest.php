<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Auth;

use App\Http\Controllers\API\Auth\LogoutController;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
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

        $this->endpoint = action(LogoutController::class);
    }

    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        // Make the request
        $this->json('POST', $this->endpoint)
            ->assertUnauthorized()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_returns_no_content_when_user_logout_successfully(): void
    {
        // Mock authenticated user
        Sanctum::actingAs(User::factory()->create());

        // Make sure user is authenticated
        $this->assertAuthenticated();

        // Make the request
        $this->json('POST', $this->endpoint)->assertNoContent();
    }
}

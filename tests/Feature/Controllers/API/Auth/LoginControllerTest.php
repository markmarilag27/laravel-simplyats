<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Auth;

use App\Http\Controllers\API\Auth\LoginController;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoginControllerTest extends TestCase
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

        $this->endpoint = action(LoginController::class);
    }

    /** @test */
    public function it_validates_empty_fields(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        /** @var $data */
        $data = [
            'email'                 => '',
            'password'              => '',
        ];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'email',
                    'password'
                ]
            ]);
    }

    /** @test */
    public function it_validates_invalid_email(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        /** @var $data */
        $data = [
            'email'                 => 'invalid.email',
            'password'              => 'password',
        ];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'email'
                ]
            ]);
    }

    /** @test */
    public function it_validates_non_existing_user(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        /** @var $data */
        $data = [
            'email'                 => $this->faker->unique()->safeEmail(),
            'password'              => 'password',
        ];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'email'
                ]
            ]);
    }

    /** @test */
    public function it_validates_wrong_user_password(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        // Mock the user
        $user = User::factory()->create();

        /** @var $data */
        $data = [
            'email'                 => $user->email,
            'password'              => 'password123',
        ];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'password'
                ]
            ]);
    }

    /** @test */
    public function it_validates_authenticated_user(): void
    {
        // Mock authenticated user
        Sanctum::actingAs(User::factory()->create());

        // Make sure user is authenticated
        $this->assertAuthenticated();

        /** @var $data */
        $data = [
            'email'                 => $this->faker->unique()->safeEmail(),
            'password'              => 'password',
        ];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
            ->assertNotFound()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_returns_user_resource_and_access_token_on_successful_login(): void
    {
        // Mock user
        $user = User::factory()->create();

        // Make sure it's a guest
        $this->assertGuest();

        /** @var $data */
        $data = [
            'email'                 => $user->email,
            'password'              => 'password',
        ];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
            ->assertOk()
            ->assertJsonStructure(['data' => [
                'access_token',
                'user' => [
                    'uuid',
                    'name',
                    'email',
                    'email_verified_at',
                    'updated_at',
                    'created_at'
                ]
            ]]);
    }
}

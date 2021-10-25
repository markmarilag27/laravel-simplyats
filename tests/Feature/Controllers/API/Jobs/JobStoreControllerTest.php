<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Jobs;

use App\Enums\JobEnvironment;
use App\Enums\JobExperience;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Http\Controllers\API\Jobs\JobStoreController;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JobStoreControllerTest extends TestCase
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

        $this->endpoint = action(JobStoreController::class);
    }

    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        /** @var $data */
        $data = [];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
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

        /** @var $data */
        $data = [
            'title'         => $this->faker->jobTitle(),
            'location'      => $this->faker->country(),
            'environment'   => $this->faker->randomElement(JobEnvironment::getValues()),
            'type'          => $this->faker->randomElement(JobType::getValues()),
            'experience'    => $this->faker->randomElement(JobExperience::getValues()),
            'description'   => $this->faker->randomHtml(),
            'status'        => $this->faker->randomElement(JobStatus::getValues()),
            'user_id'       => $user->id
        ];

        // Make the request
        $this->json('POST', $this->endpoint, $data)
            ->assertCreated()
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

<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\API\Applicants;

use App\Http\Controllers\API\Applicants\ApplicantApplicationActionController;
use App\Models\Applicant;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApplicantApplicationActionTest extends TestCase
{
    /** @test */
    public function it_validates_unauthenticated_user(): void
    {
        // Make sure it's a guest
        $this->assertGuest();

        /** @var $applicant */
        $applicant = Applicant::factory()->create();

        /** @var $endpoint */
        $endpoint = action(ApplicantApplicationActionController::class, ['applicant' => $applicant?->uuid]);

        $this->json('POST', $endpoint, ['status' => 'approve'])
            ->assertUnauthorized()
            ->assertJsonStructure([
                'message'
            ]);
    }

    /** @test */
    public function it_validates_empty_field(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        /** @var $applicant */
        $applicant = Applicant::factory()->create();

        /** @var $endpoint */
        $endpoint = action(ApplicantApplicationActionController::class, ['applicant' => $applicant?->uuid]);

        /** @var $data */
        $data = [];

        $this->json('POST', $endpoint, $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'status'
                ]
            ]);
    }

    /** @test */
    public function it_validates_invalid_status_value(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        /** @var $applicant */
        $applicant = Applicant::factory()->create();

        /** @var $endpoint */
        $endpoint = action(ApplicantApplicationActionController::class, ['applicant' => $applicant?->uuid]);

        /** @var $data */
        $data = ['status' => 'approved'];

        $this->json('POST', $endpoint, $data)
            ->assertUnprocessable()
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'status'
                ]
            ]);
    }

    /** @test */
    public function it_returns_applicant_resource_after_action(): void
    {
        // Make the user
        $user = User::factory()->create();

        // Mock authentication
        Sanctum::actingAs($user);

        // Make sure user is authenticated
        $this->assertAuthenticated();

        /** @var $applicant */
        $applicant = Applicant::factory()->create();

        /** @var $endpoint */
        $endpoint = action(ApplicantApplicationActionController::class, ['applicant' => $applicant?->uuid]);

        /** @var $data */
        $data = ['status' => 'approve'];

        $this->json('POST', $endpoint, $data)
            ->assertOk()
            ->assertJsonStructure(['data' => [
                'uuid',
                'first_name',
                'last_name',
                'location',
                'email',
                'phone',
                'status',
                'job',
                'updated_at',
                'created_at',
            ]]);
    }
}

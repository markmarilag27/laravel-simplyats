<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Create a new LoginController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('throttle:10,2');
    }

    #[Route("/api/v1/auth/login", methods: ["POST"])]
    public function __invoke(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        // Get the validated data from the request
        $payload = $request->validated();

        // If user is authenticated
        if (auth('sanctum')->check()) {
            return $this->responseWithErrorMessage(trans('generic.page_not_found'), Response::HTTP_NOT_FOUND);
        }

        /** @var $user */
        $user = User::query()->where('email', $payload['email'])->first();

        // Response error if user value is null
        if (blank($user)) {
            /** @var $message */
            $message = trans('passwords.user');
            return $this->responseWithErrors($message, [ 'email' => [$message] ]);
        }

        // Response error if payload password does not match
        if (!Hash::check($payload['password'], $user->password)) {
            /** @var $message */
            $message = trans('auth.password');
            return $this->responseWithErrors($message, [ 'password' => [$message] ]);
        }

        /** @var $accessToken */
        $accessToken = $user->createToken($request->userAgent())->plainTextToken;

        return $this->responseWithAccessToken($accessToken, $user);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Create a new LogoutController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:10,2']);
    }

    #[Route("/api/auth/logout", methods: ["POST"])]
    public function __invoke(Request $request): \Illuminate\Http\Response
    {
        /** @var $user */
        $user = $request->user();

        // Delete all the personal access token
        $user->tokens()->delete();

        return response()->noContent();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Create a new MeController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'throttle:100,1']);
    }

    #[Route("/api/auth/me", methods: ["GET"])]
    public function __invoke(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}

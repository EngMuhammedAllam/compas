<?php

namespace Modules\Auth\app\Http\Services\Api\Auth;

use Modules\Auth\app\Http\Repository\Api\AuthRepository;

class LogoutService
{

    private $repository;

    public function __construct(AuthRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke($request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }


}

<?php

namespace Modules\Auth\app\Http\Services\blade;

use Modules\Auth\app\Http\Repository\Api\AuthRepository;
use Illuminate\Support\Facades\Auth;

class LogoutService
{

    private $repository;

    public function __construct(AuthRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke($request)
    {
        $user = $request->user();

        if ($user) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Logged out successfully.');
        }
    }


}

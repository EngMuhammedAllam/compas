<?php

namespace Modules\Auth\app\Http\Services\blade;

use Modules\Auth\app\Http\Repository\Api\AuthRepository;
use Illuminate\Support\Facades\Auth;

class LogoutService
{

    private $repository;

    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $user = Auth::user();

        if ($user) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            session()->flush();
            return redirect()->route('loginform')->with('success', 'Logged out successfully.');
        }
    }
}

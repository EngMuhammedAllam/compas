<?php

namespace Modules\Auth\app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\app\Http\Requests\RegisterRequest;
use Modules\Auth\app\Http\Requests\LoginRequest;
use Modules\Auth\app\Http\Services\Api\Auth\RegisterService;
use Modules\Auth\app\Http\Services\Api\Auth\LoginService;
use Modules\Auth\app\Http\Services\Api\Auth\LogoutService;

class AuthController extends Controller
{
    protected $registerService;
    protected $loginService;
    protected $logoutService;

    public function __construct(
        RegisterService $registerService,
        LoginService $loginService,
        LogoutService $logoutService
    ) {
        $this->registerService = $registerService;
        $this->loginService    = $loginService;
        $this->logoutService   = $logoutService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->registerService->__invoke($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->loginService->__invoke($request);
    }

    public function logout(Request $request)
    {
        return $this->logoutService->__invoke($request);
    }

}

<?php

namespace Modules\Auth\app\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\app\Http\Requests\RegisterRequest;
use Modules\Auth\app\Http\Requests\LoginRequest;
use Modules\Auth\app\Http\Services\blade\RegisterService;
use Modules\Auth\app\Http\Services\blade\LoginService;
use Modules\Auth\app\Http\Services\blade\LogoutService;

class AuthController extends Controller
{

    protected $loginservice;
    protected $logoutservice;
    protected $registerservice;


    public function __construct(
        LoginService $loginservice,
        LogoutService $logoutservice,
        RegisterService $registerservice

    )
    {
        $this->loginservice = $loginservice;
        $this->logoutservice = $logoutservice;
        $this->registerservice = $registerservice;
        
    }

    public function register(RegisterRequest $request)
    {
        return $this->registerservice->__invoke($request);
    }

    public function loginForm()
    {
        return view('auth::auth.login');
    }

    public function login(LoginRequest $request)
    {
        return $this->loginservice->__invoke($request);
    }

    public function logout(Request $request)
    {
        return $this->logoutservice->__invoke($request);
    }

}

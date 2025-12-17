<?php

namespace Modules\Auth\app\Http\Services\blade;

use Modules\Auth\app\Http\Repository\Api\AuthRepository;
use App\Http\Traits\ResponseTrait;
use Exception;
use Modules\Auth\app\Http\Resources\Api\UserAuthResource;

class RegisterService
{
    use ResponseTrait;

    private $repository;
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($request) 
    {
        try {
            $user = $this->repository->create($request);
            return redirect()->route('login')->with('success', 'User registered successfully');
        } catch (Exception $e) {
            return redirect()->route('register')->with('error', $e->getMessage());
        }
    }

}

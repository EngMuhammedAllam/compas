<?php

namespace Modules\Auth\app\Http\Services\Api\Auth;

use Modules\Auth\app\Http\Repository\Api\AuthRepository;
use App\Http\Traits\ResponseTrait;
use Modules\Auth\app\Http\Resources\Api\UserAuthResource;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class LoginService
{
    use ResponseTrait;

    private $repository;

    public function __construct(AuthRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke($request)
    {
        try {
            $user = $this->repository->find($request);

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return $this->sendResponseError(
                    data: [],
                    code: 401,
                    message: 'Invalid credentials'
                );
            }

            $user->token = $user->createToken('API Token')->plainTextToken;

            return $this->jsonResponseSuccess(
                data: new UserAuthResource($user),
                message: 'Logged in successfully',
                code: 200
            );
        } catch (Exception $e) {
            return $this->sendResponseError(
                data: $e->getMessage(),
                code: 500,
                message: 'Internal Server Error'
            );
        }
    }
}

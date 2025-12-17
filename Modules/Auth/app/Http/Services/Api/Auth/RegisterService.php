<?php

namespace Modules\Auth\app\Http\Services\Api\Auth;

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
            return $this->jsonResponseSuccess(
                data: new UserAuthResource($user),
                message: "User registered successfully",
                code: 201
            );
        } catch (Exception $e) {
            return $this->sendResponseError(
                data: $e->getMessage(),
                code: 500,
                message: "Internal Server Error"
            );
        }
    }

}

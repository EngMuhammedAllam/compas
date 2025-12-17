<?php


namespace Modules\Auth\app\Http\Repository\Api;

use Modules\Auth\app\Http\Interface\Api\AuthInterface;
use App\Http\Requests\Api\public\Auth\loginRequest;
use App\Http\Requests\Api\public\Auth\RegisterRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthRepository implements AuthInterface
{

    use ResponseTrait;

    /**
     * @param RegisterRequest $request
     * @return mixed
     */
    public function create($request)
    {
        return DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);

            $user->token = $user->createToken('API Token')->plainTextToken;
            return $user;
        });
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function find($request)
    {
        return  User::where('email', $request->email)->orWhere('phone', $request->email)->first(); 
    }

}

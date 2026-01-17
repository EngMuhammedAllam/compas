<?php


namespace Modules\Auth\app\Http\Repository\Api;

use App\Models\Auth\User;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\public\Auth\loginRequest;
use App\Http\Requests\Api\public\Auth\RegisterRequest;
use Modules\Auth\app\Http\Interface\Api\AuthInterface;

class AuthRepository implements AuthInterface
{

    use ResponseTrait;

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

    public function find($request)
    {
        return  User::where('email', $request->email)->orWhere('phone', $request->email)->first();
    }
}

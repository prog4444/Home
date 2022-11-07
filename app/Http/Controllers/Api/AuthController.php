<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @property AuthToken = "authToken"
 * @method register(RegisterRequest $request)
 * @method login(LoginRequest $request)
 */

class AuthController extends Controller
{
    const AuthToken = 'authToken';

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken(AuthController::AuthToken)->accessToken;
        return response()->json([
            'token' => $token
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorised'], 401);
        } else {
            $token = auth()->user()->createToken(AuthController::AuthToken)->accessToken;
            return response()->json([
                'token' => $token
            ]);
        }
    }

}

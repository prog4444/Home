<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(),
            [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            ]
    );
    if ($validated->fails()){
        return response()->json([
            'errors' => $validated->errors()
        ]);
    }
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);
    
    $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;

    return response()->json([
        'token' => $token
    ],200);
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|string',
                'password' => 'required|string'
            ]
        );
        if (!auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorised'], 401);
        } else {
            $success['token'] = auth()->user()->createToken('authToken')->accessToken;
            $success['user'] = auth()->user();
            return response()->json(['success' => $success])->setStatusCode(200);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users, email',
            'password' => 'required|string|min:6|confirmed'

        ]);
        
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        $token = $user->createToken('Api Token');
        $code = 200;
        return response()->json([
            'status' => 'Succes',
            'message' => 'succesfull registered',
            'data' => $token,

        ], $code);
    }

    public function read()
    {
        $user_all = User::all();
        return $user_all;
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users, email',
            'password' => 'required|string|min:6|confirmed'

        ]);
        if($validator->fails())
        {
            return response()->json([
                'errors' => $validator->errors()

            ], 422);
        }
        try {
            $inter = User::find($id);
            if($inter){
                $inter->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password
                ]);
                return response()->json([
                    'message' => 'изменень'
                ]);
            }else{
                return response()->json([
                    'message' => 'not fount'

                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Not !(((',
            ], 422);
        } 
    }

}

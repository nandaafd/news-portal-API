<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message'=>'Email atau Password salah'
            ], 401);
        }
        $user = $request->user();
        $token = $user->createToken('Access Token')->accessToken;
        $user->access_token = $token;
        return response()->json([
            'user'=>$user
        ],200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message'=>'User logout successfully'
        ],200);
    }

}

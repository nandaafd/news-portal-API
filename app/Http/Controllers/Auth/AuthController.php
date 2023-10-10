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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'role'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }  
        
        $password =  $request->password;
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'message'=>'User register successfully',
            'data'=>$user,
        ],201);
    }
    public function index()
    {
        return 'oke';
    }
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message'=>'User logout successfully'
        ],200);
    }

}

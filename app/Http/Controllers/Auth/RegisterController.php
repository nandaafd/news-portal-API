<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
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
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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
        
        $data = $request->all();
        $result = $this->userRepository->storeUser($data);
        
        return response()->json([
            'message'=>'User register successfully',
            'data'=>$result,
        ],201);
    }
}

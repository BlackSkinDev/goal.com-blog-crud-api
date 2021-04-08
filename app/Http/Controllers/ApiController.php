<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ApiController extends Controller
{

	public $loginAfterSignUp = true;
 
    public function register(AdminRegisterRequest $request)
    {

        User::create([
        	'name'=>$request->name,
        	'email'=>$request->email,
        	'password'=> bcrypt($request->password)
        ]);
 
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
 
        return response()->json([
            'success' => true,
            'user' => $user
        ], 200);
    }
 
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;
 
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
 
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }
 
    public function logout(Request $request)
    {
      
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
 
    public function getAuthUser(Request $request)
    {
        
        $user = JWTAuth::user();
 
        return response()->json(['user' => $user],200);
    }

 
    
}

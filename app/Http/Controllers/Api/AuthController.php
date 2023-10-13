<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            // Validate user input
            $validateUser = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'mobile' => 'required',
                'house' => 'required',
                'street' => 'required',
                'city' => 'required',
                'dob' => 'required',
            ]);
    
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
    
            // Create a new user record
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'house' => $request->input('house'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'dob' => $request->input('dob'),
                'password' => Hash::make($request->input('password')),
            ]);
    
            $user = auth()->user();
            return response()->json([
                'status' => true,
                'message' => 'User Registered Successfully',
            ], 200);
    
        } catch (\Throwable $th) {
            error_log($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            // Get the 'is_admin' value from the user instance
            $abilities = $user->is_admin ? ['admin'] : ['standard'];

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN", $abilities)->plainTextToken
            ], 200);

            return view('home');

            // $accessToken = $user->createToken("API TOKEN", $abilities)->plainTextToken;
    
            // // Return the 'home' view
            // return view('home')->with('access_token', $accessToken);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}


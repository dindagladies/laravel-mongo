<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    // Register
    public function register(Request $request)
    {
        // Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6:max:50'
        ]);

        // If request is not valid, send failed response
        if($validator->fails()){
            return response()->json(['error' => $validator->message()], 200);
        }

        // Request valid, create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    // Authenticate
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        // If request is not valid, send failed response
        if($validator->fails()){
            return response()->json(['error' => $validator->message()], 200);
        }

        // If request valid
        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid',
                ], 400);
            }
        } catch(JWTException $e){
            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token',
            ], 500);
        }

        // Success response & token created
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        // Valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        // If request is not valid, send failed response
        if($validator->fails()){
            return response()->json(['error' => $validator->message()], 200);
        }

        // Request valid, do logout
        try{
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        }catch (JWTException $exception){
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // Get user
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
}

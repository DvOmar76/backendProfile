<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;


class loginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
//            $request->session()->regenerate();
            return response()->json([
//                'token' => $user->createToken('YourAppName')->plainTextToken,
                'user' => $user
            ]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // public function loginUser(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);
 
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
 
    //         return response()->json([
    //                     'message' => 'Login successful',
    //                 ]);
    //     }
    // }

    public function loginUser(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Check if the user exists and the credentials are correct
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Generate a new token for the user
        $token = $user->createToken('Laravel', ['server:update'])->plainTextToken;

        // Return the token to the client
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }
    public function validateToken(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
    if ($user) {
        return response()->json(['message' => 'Token is valid'], 200);
    }
    return response()->json(['message' => 'Token is invalid'], 401);
    }
    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            // Revoke the current token
            $user->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully'], 200);
        }
        return response()->json(['message' => 'User not authenticated'], 401);
    }

    public function registerUser(Request $request)
{
    // Validate the incoming request
    // $validator = Validator::make($request->all(), [
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|string|email|max:255|unique:users',
    //     'password' => 'required|string|min:8|confirmed', // Ensure password confirmation
    // ]);

    // if ($validator->fails()) {
    //     return response()->json(['errors' => $validator->errors()], 422);
    // }

    // Create a new user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash the password
    ]);

    // Generate a token for the new user
    // $token = $user->createToken('YourAppName')->plainTextToken;

    // Return the response with the token
    return response()->json([
        'message' => 'Registration successful',
        // 'token' => $token,
        'user' => $user,
    ], 201);
}
}

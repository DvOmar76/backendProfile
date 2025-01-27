<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

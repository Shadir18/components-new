<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (Auth::attempt($attributes)) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Logged in successfully',
                'user' => Auth::user()
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function destroy()
    {
        Auth::logout();
        return response()->json([
        'message' => 'Logged out successfully'
    ], 200);
    }
}

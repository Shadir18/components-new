<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use App\Models\Seller;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);
        try {
            DB::beginTransaction();
            $user = User::create($attributes);
            Seller::create([
                'user_id' => $user->id,
                'name' => $attributes['first_name']
            ]);
            DB::commit();
            Auth::login($user);
            return response()->json([
                'message' => 'Your account has been created successfully!',
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
            'message' => 'Registration failed',
        ], 500);
        }
    }
}
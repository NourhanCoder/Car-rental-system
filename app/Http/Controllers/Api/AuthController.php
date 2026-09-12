<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'full_name' => $validated['full_name'],
            'user_name' => $validated['user_name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'],
            'address'   => $validated['address'],
            'password'  => Hash::make($validated['password']),
            'is_admin'  => false,
            'is_active' => true,
        ]);
        $user->notify(new WelcomeNotification());

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user' => [
                'id'        => $user->id,
                'full_name' => $user->full_name,
                'user_name' => $user->user_name,
                'email'     => $user->email,
                'phone'     => $user->phone,
                'address'   => $user->address,
                'image'     => $user->image ? asset('storage/' . $user->image) : null,
                'role'      => $user->is_admin ? 'admin' : 'user',
            ],
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 'User registered successfully.', 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'is_active' => 1,
        ])) {
            return $this->errorResponse('Invalid credentials or account is inactive.', 401);
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse([
            'user' => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'user_name' => $user->user_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'image' => $user->image ? asset('storage/' . $user->image) : null,
                'role' => $user->is_admin ? 'admin' : 'user',

            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Logged in successfully.');
    }

    /**
     * Get authenticated user profile (me).
     */

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return $this->successResponse([
            'user' => [
                'id'        => $user->id,
                'full_name' => $user->full_name,
                'user_name' => $user->user_name,
                'email'     => $user->email,
                'phone'     => $user->phone,
                'address'   => $user->address,
                'image'     => $user->image ? asset('storage/' . $user->image) : null,
                'role'      => $user->is_admin ? 'admin' : 'user',
            ],
        ], 'User profile retrieved successfully.');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successResponse(null, 'Logged out successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        Auth::login($user);

        return $this->success([], 'Your account registered successfully');
    }

    /**
     * @throws \Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            throw new \Exception('Credential mismatched!', 401);
        }

        return $this->success([], 'You\'r logged in successfully');
    }

    public function user(): JsonResponse
    {
        return $this->success(Auth::user(), '');
    }

    public function logout(): JsonResponse
    {
        Auth::guard('web')->logout();
        return $this->success([], 'You logout successfully!');
    }
}

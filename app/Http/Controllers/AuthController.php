<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\User;

use JWTAuth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestController;

use Illuminate\Support\Facades\Validator;

use App\Services\UserService;

class AuthController extends Controller
{
    //
}

public function register(Request $request)
{
	$validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
	
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

	$user = $userService->createUser($userData);
	
    $token = JWTAuth::fromUser($user);

    return response()->json(compact('user', 'token'), 201);
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    return response()->json(compact('token'));
}

public function logout()
{
    JWTAuth::invalidate();

    return response()->json(['message' => 'Successfully logged out']);
}

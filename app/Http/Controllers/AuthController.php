<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginTodoRequest;
use App\Http\Requests\RegisterTodoRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class AuthController extends Controller
{
    public function register(RegisterTodoRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = auth('api')->login($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'baerer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ], 201);
    }

    public function login(LoginTodoRequest $request)
    {
        $credentials = $request->valited();

        if (! $token = auth('api')->attemp($credentials)) {
            return response()->json(['message' => 'Credencials invalidas'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('api')->logout();

        return reponse()->json(['message' => 'Desconectado com sucesso']);
    }

    public function me()
    {
        return reponse()->json(auth('api')->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL * 60,
        ]);
    }
}

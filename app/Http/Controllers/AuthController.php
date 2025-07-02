<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:10|string',
            'email' => 'required|email:rfc,dns|string|min:10|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password'])
        ]);

        if($user)
        {
            $token = $user->createToken('api-token',['post:create','post:read'])->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ],201);
        }

        return response()->json([
            'status' => 500,
            'message' => "Erro ao criar o usuário",
        ],500);
    }

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email:rfc,dns|string|min:10',
            'password' => 'required|min:8'
        ]);

        $validateAuth = Auth::attempt(['email' => $validator['email'], 'password' => $validator['password']]);

        if($validateAuth)
        {
            $user = User::where('email', $validator['email'])->first();

            $token = $user->createToken('api-token',['post:create','post:read'])->plainTextToken;

            return response()->json([
                'token' => $token
            ],201);
        }

        return response()->json([
            'status' => 500,
            'message' => "Usuário não cadastrado",
        ],500);
    }

    public function logout(Request $request)
    {

        $validateToken = PersonalAccessToken::findToken($request['token']);

        if($validateToken)
        {
            $validateToken->delete();

            return response()->json([
                'message' => "Token removido com sucesso"
            ],201);
        }

        return response()->json([
            'status' => 500,
            'message' => "Token invalido",
        ],500);
    }
}

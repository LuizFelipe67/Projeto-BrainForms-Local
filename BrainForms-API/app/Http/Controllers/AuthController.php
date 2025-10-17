<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validação dos dados
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. Buscar usuário na tabela 'alunos'
        $aluno = Aluno::where('email', $request->email)->first();

        if (!$aluno || !Hash::check($request->password, $aluno->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        // 3. Criar token com expiração de 15 minutos
        $token = $aluno->createToken('api-token', [], now()->addMinutes(15))->plainTextToken;

        // 4. Retornar JSON com token e dados do aluno
        return response()->json([
            'status' => 200,
            'message' => 'Login realizado com sucesso',
            'token' => $token,
            'user' => [
                'id' => $aluno->id,
                'name' => $aluno->name,
                'email' => $aluno->email,
                'primeiro_login' => $aluno->primeiro_login
            ]
        ]);
    }
}

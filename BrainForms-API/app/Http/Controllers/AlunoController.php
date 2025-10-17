<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoRequest;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Conquista;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlunoRequest $request)
    {
       
        $aluno = Aluno::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // DESBLOQUEAR A PRIMEIRA CONQUISTA AUTOMATICAMENTE
        $primeiraConquista = Conquista::find(1); // A Jornada
        if ($primeiraConquista) {
            $aluno->conquistas()->attach($primeiraConquista->id);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Aluno cadastrado com sucesso',
            'aluno' => $aluno
        ]);

    }

    public function marcarBoasVindas($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->primeiro_login = false;
        $aluno->save();

        return response()->json(['message' => 'Boas-vindas marcada como vista']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

use Illuminate\Http\Request;

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConquistaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathResponseController; 
use App\Http\Controllers\FisResponseController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\HistoricoFormulaController;
use App\Models\Aluno;
use App\Models\Conquista;

Route::post('/alunos/cadastrar', [AlunoController::class, 'store']);
Route::post('alunos/login', [AuthController::class, 'login']);

//salvar o nome do aluno logado
Route::middleware('auth:sanctum')->get('/alunos/nome', function (Request $request) {
    return response()->json([
        'name' => $request->user()->name,
    ]);
});

Route::post('/alunos/{id}/marcar-boas-vindas', [AlunoController::class, 'marcarBoasVindas']);


Route::middleware('auth:sanctum')->get('/alunos/me', function (Request $request) {
    return response()->json($request->user());
});

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/perfil', function (Request $request) {
        return $request->user();
    });


    Route::post('/logout', [AuthController::class, 'logout']);

     // Rotas de matemática 
    Route::post('/math-responses', [MathResponseController::class, 'store']);
    
    // ROTA PARA FÍSICA 
    Route::post('/fis-responses', [FisResponseController::class, 'store']);
    });

    // Rota de Conquistas
    Route::middleware('auth:sanctum')->get('/alunos/conquistas', [ConquistaController::class, 'listar']);

    // Rotas de Fórmulas e Histórico de Fórmulas
    Route::middleware('auth:sanctum')->group(function () {
    Route::get('/formulas', [FormulaController::class, 'index']);
    Route::get('/formulas/{id}', [FormulaController::class, 'show']);

    Route::post('/historico-formulas', [HistoricoFormulaController::class, 'store']);
    Route::get('/historico-formulas', [HistoricoFormulaController::class, 'listarPorAluno']);
    });



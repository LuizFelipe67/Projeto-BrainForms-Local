<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoricoFormula;
use App\Models\Formula;
use Illuminate\Support\Facades\DB;

class HistoricoFormulaController extends Controller
{
    public function store(Request $request)
    {
        // validação básica
        $data = $request->validate([
            'formula_id' => ['required','integer','exists:formulas,id'],
            'valores'    => ['nullable','array'],
            'resultado'  => ['nullable','array'],
        ]);

        $aluno = $request->user();
        if (!$aluno) {
            return response()->json(['message' => 'Não autenticado'], 401);
        }

        DB::beginTransaction();
        try {
            $historico = HistoricoFormula::create([
                'aluno_id'   => $aluno->id,
                'formula_id' => $data['formula_id'],
                'valores'    => $data['valores'] ?? null,
                'resultado'  => $data['resultado'] ?? null,
            ]);

            // lógica de conquistas (ex.: tipo matematica => conquista id 2)
            $formula = Formula::find($data['formula_id']);
            $novas = [];

            if ($formula) {
                if ($formula->tipo === 'matematica') {
                    $conquistaId = 2;
                } elseif ($formula->tipo === 'fisica') {
                    $conquistaId = 5; // exemplo
                } else {
                    $conquistaId = null;
                }

                if ($conquistaId) {
                    $jaTem = $aluno->conquistas()->where('conquistas.id', $conquistaId)->exists();
                    if (!$jaTem) {
                        $aluno->conquistas()->attach($conquistaId);
                        $novas[] = $conquistaId;
                    }
                }
            }

            DB::commit();

            // Retorna histórico + conquistas recém-desbloqueadas + lista atualizada de conquistas do aluno
            $conquistasAtualizadas = $aluno->conquistas()->get();

            return response()->json([
                'status' => 200,
                'historico' => $historico,
                'novas_conquistas' => $novas,
                'conquistas' => $conquistasAtualizadas,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao salvar histórico', 'error' => $e->getMessage()], 500);
        }
    }

    public function listarPorAluno(Request $request)
    {
        $aluno = $request->user();
        return response()->json([
            'historico' => $aluno->historicos()->with('formula')->orderByDesc('data_uso')->get(),
            'conquistas' => $aluno->conquistas()->get(),
        ]);
    }
}

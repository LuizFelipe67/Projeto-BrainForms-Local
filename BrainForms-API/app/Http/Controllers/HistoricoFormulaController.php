<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoricoFormula;
use App\Models\Formula;
use App\Models\Conquista;
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
                // Conquista 9: Mestre Geométrico (fórmulas de geometria: IDs 2, 3, 4, 5)
                $formulasGeometria = [2, 3, 4, 5]; // Área do Círculo, Volume da Esfera, Área do Triângulo, Volume do Cilindro
                if (in_array($data['formula_id'], $formulasGeometria)) {
                    $conquistaId = 9;
                    $jaTem = $aluno->conquistas()->where('conquistas.id', $conquistaId)->exists();
                    if (!$jaTem) {
                        $aluno->conquistas()->attach($conquistaId);
                        $novas[] = $conquistaId;
                    }
                }
                
                // Conquista 10: Mestre da Conversão (fórmula de conversão de temperatura: ID 10)
                if ($data['formula_id'] == 10) {
                    $conquistaId = 10;
                    $jaTem = $aluno->conquistas()->where('conquistas.id', $conquistaId)->exists();
                    if (!$jaTem) {
                        $aluno->conquistas()->attach($conquistaId);
                        $novas[] = $conquistaId;
                    }
                }
                
                // Conquista 2: Matemática Forms (qualquer fórmula de matemática)
                if ($formula->tipo === 'matematica') {
                    $conquistaId = 2;
                    $jaTem = $aluno->conquistas()->where('conquistas.id', $conquistaId)->exists();
                    if (!$jaTem) {
                        $aluno->conquistas()->attach($conquistaId);
                        $novas[] = $conquistaId;
                    }
                }
                
                // Conquista 5: Físico Forms (qualquer fórmula de física)
                if ($formula->tipo === 'fisica') {
                    $conquistaId = 5;
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

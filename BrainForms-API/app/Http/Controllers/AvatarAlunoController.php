<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Aluno; // Importa o model correto
use App\Models\Conquista; // Importa o model de Conquista

class AvatarAlunoController extends Controller
{
    // Atualiza o avatar do aluno logado
    public function update(Request $request)
    {
        $aluno = $request->user(); // Obtém o aluno autenticado (via Sanctum)

        // Verifica se é upload de arquivo ou URL
        if ($request->hasFile('avatar')) {
            // Upload de arquivo
            $request->validate([
                'avatar' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120|dimensions:max_width=4096,max_height=4096',
            ], [
                'avatar.max' => 'A imagem deve ter no máximo 5MB',
                'avatar.dimensions' => 'A imagem deve ter no máximo 4096x4096 pixels',
                'avatar.mimes' => 'A imagem deve ser JPG, PNG, GIF ou WebP',
            ]);

            // Remove o avatar antigo se for um arquivo (não URL)
            if ($aluno->avatar && !filter_var($aluno->avatar, FILTER_VALIDATE_URL) && Storage::disk('public')->exists($aluno->avatar)) {
                Storage::disk('public')->delete($aluno->avatar);
            }

            // Salva o novo avatar
            $path = $request->file('avatar')->store('avatars', 'public');

            // Atualiza o caminho no banco de dados
            $aluno->avatar = asset('storage/' . $path);
            $aluno->save();

            // Desbloqueia a conquista 7 (De Cara Nova)
            $conquista = Conquista::find(7);
            if ($conquista && !$aluno->conquistas()->where('conquista_id', 7)->exists()) {
                $aluno->conquistas()->attach(7);
            }

            return response()->json([
                'message' => 'Avatar personalizado atualizado com sucesso!',
                'avatar_url' => asset('storage/' . $path),
            ]);
        } elseif ($request->has('avatar_url')) {
            // Avatar da galeria (URL local)
            $request->validate([
                'avatar_url' => 'required|string',
            ]);

            // Salva a URL do avatar da galeria
            $aluno->avatar = $request->avatar_url;
            $aluno->save();

            // Desbloqueia a conquista 7 (De Cara Nova)
            $conquista = Conquista::find(7);
            if ($conquista && !$aluno->conquistas()->where('conquista_id', 7)->exists()) {
                $aluno->conquistas()->attach(7);
            }

            return response()->json([
                'message' => 'Avatar da galeria atualizado com sucesso!',
                'avatar_url' => $request->avatar_url,
            ]);
        }

        return response()->json([
            'message' => 'Nenhum avatar fornecido.',
        ], 400);
    }

    // Retorna o avatar atual do aluno logado
    public function show(Request $request)
    {
        $aluno = $request->user();

        return response()->json([
            'avatar_url' => $aluno->avatar ?? null,
        ]);
    }

    public function delete(Request $request)
    {
        $aluno = $request->user();

        if ($aluno->avatar && Storage::disk('public')->exists($aluno->avatar)) {
            Storage::disk('public')->delete($aluno->avatar);
            $aluno->avatar = null;
            $aluno->save();
        }

        return response()->json(['message' => 'Avatar removido.']);
    }

}

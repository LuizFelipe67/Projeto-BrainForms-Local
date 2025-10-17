<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConquistasSeeder extends Seeder
{
    public function run()
    {
        DB::table('conquistas')->insertOrIgnore([
            [
                'id' => 1,
                'name' => 'A Jornada',
                'cor' => '#EDBCFF',
                'descricao' => 'Seja muito bem-vindo ao BrainForms.<br>Sua jornada começa aqui!!<br>(essa é sua 1° conquista por acessar o sistema)',
                'icone' => 'Imagens/conquista1.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Matemática Forms',
                'cor' => '#3C71ED',
                'descricao' => 'Vamos explorar o Universo da Matemática.<br>Efetue um Cálculo em Fórmulas Matemáticas!',
                'icone' => 'Imagens/conquista2.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Em Prática',
                'cor' => '#e74c3c',
                'descricao' => 'Conclua exercícios práticos para reforçar seu aprendizado.<br>Finalize algum questionário do BrainForms!!',
                'icone' => 'Imagens/conquista3.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'name' => 'Game Maker',
                'cor' => '#8e44ad',
                'descricao' => 'Estudar nem sempre é chato, ainda mais com o BrainForms.<br>Finalize o TimeQuizz na zona de minigames!',
                'icone' => 'Imagens/conquista4.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'name' => 'Físico Forms',
                'cor' => '#3CED68',
                'descricao' => 'Vamos explorar o Universo da Física.<br>Efetue um Cálculo em Fórmulas Físicas!',
                'icone' => 'Imagens/conquista5.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'name' => 'Disciplinado',
                'cor' => '#FFEB3C',
                'descricao' => 'O Foco e Disciplina movem montanhas.<br>Mantenha-se firme em seus estudos por 3 dias seguidos!',
                'icone' => 'Imagens/conquista6.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'name' => 'De Cara Nova',
                'cor' => '#9747FF',
                'descricao' => 'QUE CHARME!!<br>Altere sua foto de perfil.',
                'icone' => 'Imagens/conquista7.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'name' => 'Genio do Questionário',
                'cor' => 'linear-gradient(180deg, #00f7ff 0%, #6a00ff 55%)',
                'descricao' => 'Uau! Você é um gênio dos questionários!<br>Complete um questionário com 100% de acertos.',
                'icone' => 'Imagens/conquista8.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'name' => 'Mestre Geométrico',
                'cor' => '#001CD3',
                'descricao' => 'Aprender Geometria é divertido!<br>Efetue um cálculo de Fórmulas Geométricas.',
                'icone' => 'Imagens/conquista9.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'name' => 'Mestre da Conversão',
                'cor' => '#d35400',
                'descricao' => 'Aprender sobre temperaturas é incrivél!<br>Efetue um cálculo de Conversão de Temperaturas.',
                'icone' => 'Imagens/conquista10.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'name' => 'Gênio do TimeQuizz',
                'cor' => 'linear-gradient(180deg, #B400D3 0%, #6a00ff 55%)',
                'descricao' => 'Ágil e Certeiro!!<br>Um verdadeiro Gênio do TimeQuizz.<br>Acerte todas as questões em um TimeQuizz.',
                'icone' => 'Imagens/conquista11.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'name' => 'Boa Tentativa',
                'cor' => '#2980b9',
                'descricao' => 'Essa foi Quase!!<br>Erre apenas uma questão no TimeQuizz.',
                'icone' => 'Imagens/conquista12.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

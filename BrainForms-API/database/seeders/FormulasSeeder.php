<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormulasSeeder extends Seeder
{
    public function run()
    {
        DB::table('formulas')->insertOrIgnore([
            // -------------------- MATEMÁTICA --------------------
            //1
            [
                'name' => 'Cálculo de Equações 2º Grau (Bhaskara)',
                'tipo' => 'matematica',
                'descricao' => 'Resolve equações do 2º grau (ax² + bx + c = 0).',
                'expressao' => 'x = (-b ± √(b² - 4ac)) / (2a)',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //2
            [
                'name' => 'Área do Círculo',
                'tipo' => 'matematica',
                'descricao' => 'Calcula a área de um círculo a partir do raio.',
                'expressao' => 'A = π · r²',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //3
            [
                'name' => 'Volume da Esfera',
                'tipo' => 'matematica',
                'descricao' => 'Calcula o volume de uma esfera a partir do raio.',
                'expressao' => 'V = (4/3) · π · r³',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //4
            [
                'name' => 'Área do Triângulo',
                'tipo' => 'matematica',
                'descricao' => 'Calcula a área de um triângulo a partir da base e altura.',
                'expressao' => 'A = (b · h) / 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //5
            [
                'name' => 'Volume do Cilindro',
                'tipo' => 'matematica',
                'descricao' => 'Calcula o volume de um cilindro a partir do raio e altura.',
                'expressao' => 'V = π · r² · h',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //6
            [
                'name' => 'Trigonometria (Seno, Cosseno e Tangente)',
                'tipo' => 'matematica',
                'descricao' => 'Relações trigonométricas em triângulos retângulos.',
                'expressao' => 'sen(θ) = cateto oposto / hipotenusa | cos(θ) = cateto adjacente / hipotenusa | tg(θ) = cateto oposto / cateto adjacente',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //7
            [
                'name' => 'Logaritmo',
                'tipo' => 'matematica',
                'descricao' => 'O logaritmo geral é o expoente ao qual uma base deve ser elevada para obter um número.',
                'expressao' => 'log_b(a) = x ⇔ b^x = a',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //8
            [
                'name' => 'Logaritmo Natural',
                'tipo' => 'matematica',
                'descricao' => 'O logaritmo natural (ln) é o logaritmo na base e, utilizado para crescimento exponencial e processos naturais.',
                'expressao' => 'ln(a) = x ⇔ e^x = a',
                'created_at' => now(),
                'updated_at' => now()
            ],
            //9
            [
                'name' => 'Logaritmo Base 10',
                'tipo' => 'matematica',
                'descricao' => 'O logaritmo base 10 (log10) é amplamente usado em ciências e engenharia para escalas logarítmicas.',
                'expressao' => 'log10(a) = x ⇔ 10^x = a',
                'created_at' => now(),
                'updated_at' => now()
            ],




            // -------------------- FÍSICA --------------------
            [
                'name' => 'Conversão de Temperaturas',
                'tipo' => 'fisica',
                'descricao' => 'Converte valores entre Celsius, Fahrenheit e Kelvin.',
                'expressao' => 'C → F: (C · 9/5) + 32 | C → K: C + 273,15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'MRU - Posição Final',
                'tipo' => 'fisica',
                'descricao' => 'Movimento Retilíneo Uniforme: calcula posição final.',
                'expressao' => 'S = S0 + v · t',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Eletrostática (Lei de Coulomb)',
                'tipo' => 'fisica',
                'descricao' => 'Força entre duas cargas elétricas.',
                'expressao' => 'F = k · (q1 · q2) / d²',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Velocidade Média',
                'tipo' => 'fisica',
                'descricao' => 'Relação entre distância percorrida e intervalo de tempo.',
                'expressao' => 'Vm = ΔS / Δt',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

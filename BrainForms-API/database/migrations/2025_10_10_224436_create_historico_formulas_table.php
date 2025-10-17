<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('historico_formulas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('formula_id');
            $table->json('valores')->nullable();   // valores fornecidos pelo aluno
            $table->json('resultado')->nullable(); // resultado do cálculo
            $table->timestamp('data_uso')->useCurrent();
            $table->timestamps();

            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('formula_id')->references('id')->on('formulas')->onDelete('cascade');

            $table->index(['aluno_id', 'formula_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historico_formulas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Ex: Bhaskara, Área do Círculo
            $table->enum('tipo', ['matematica','fisica']);
            $table->text('descricao')->nullable(); // explicação teórica
            $table->text('expressao')->nullable(); // representação simbólica opcional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formulas');
    }
};

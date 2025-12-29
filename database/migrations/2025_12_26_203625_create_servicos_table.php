<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordens_servico', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('carro_id')->constrained('carros')->cascadeOnDelete();
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->char('descricao', 300);
            $table->integer('status')->default(0);
            $table->dateTime('data_abertura')->useCurrent();
            $table->decimal('valor_total', 10, 2)->nullable();
        });

        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->char('nome', 90);
            $table->timestamps();
        });

        Schema::create('ordens_servico_registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ordem_servico_id')
                ->constrained('ordens_servico')
                ->cascadeOnDelete();\
            $table->foreignId('servico_id')
                ->constrained('servicos')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordem_servico_registros');
        Schema::dropIfExists('servicos');
        Schema::dropIfExists('ordens_servico');
    }
};

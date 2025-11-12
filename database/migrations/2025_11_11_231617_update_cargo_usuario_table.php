<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cargo_usuario', function (Blueprint $table) {
            // Remover a foreign antiga usando o nome correto
            $table->dropForeign('cargo_usuario_usuario_id_foreign');

            // Renomear a coluna
            $table->renameColumn('usuario_id', 'user_id');

            // Recriar a foreign key com o novo nome de coluna
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('cargo_usuario', function (Blueprint $table) {
            // Reverter as alterações
            $table->dropForeign('cargo_usuario_user_id_foreign');
            $table->renameColumn('user_id', 'usuario_id');
            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistradoPorToUsuariosTable extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Se agrega la columna como nullable para que no rompa los lectores viejos que ya tenías creados
            $table->foreignId('registrado_por')->nullable()->after('activo')->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['registrado_por']);
            $table->dropColumn('registrado_por');
        });
    }
}
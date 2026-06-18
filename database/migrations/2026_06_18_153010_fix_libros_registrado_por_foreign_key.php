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
        Schema::table('libros', function (Blueprint $table) {
            $table->dropForeign('libros_registrado_por_foreign');
            $table->foreign('registrado_por')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('libros', function (Blueprint $table) {
            $table->dropForeign('libros_registrado_por_foreign');
            $table->foreign('registrado_por')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    public function up(): void
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();

            $table->string('titulo');
            $table->string('autor');
            $table->string('editorial');
            $table->year('anio');
            $table->string('estado');
            $table->string('imagen')->nullable();
            $table->foreignId('registrado_por')->constrained('usuarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
}
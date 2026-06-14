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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained();
            $table->dateTime('fecha');
            $table->decimal('total', 10, 2);
            //$table->unsignedBigInteger('cliente_id');
            //$table->foreign('cliente_id')->references('id')->on('clientes');
            $table->string('tipopago');
            $table->decimal('saldopendiente', 10, 2)->nullable();
            $table->string('estado');
            $table->string('registradopor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};

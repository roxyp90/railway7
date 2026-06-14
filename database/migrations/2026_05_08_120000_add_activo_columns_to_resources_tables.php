<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['users', 'usuarios', 'libros', 'prestamos', 'sanciones'];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table) || Schema::hasColumn($table, 'activo')) {
                continue;
            }

            Schema::table($table, function (Blueprint $table) {
                $table->boolean('activo')->default(true);
            });
        }
    }

    public function down(): void
    {
        $tables = ['users', 'usuarios', 'libros', 'prestamos', 'sanciones'];

        foreach ($tables as $table) {
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'activo')) {
                continue;
            }

            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('activo');
            });
        }
    }
};

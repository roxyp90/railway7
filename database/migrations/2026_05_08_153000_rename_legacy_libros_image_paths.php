<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('libros') || ! Schema::hasColumn('libros', 'imagen')) {
            return;
        }

        DB::table('libros')
            ->where('imagen', 'like', 'libros/%')
            ->update([
                'imagen' => DB::raw("REPLACE(imagen, 'libros/', 'uploads/libros/')"),
            ]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('libros') || ! Schema::hasColumn('libros', 'imagen')) {
            return;
        }

        DB::table('libros')
            ->where('imagen', 'like', 'uploads/libros/%')
            ->update([
                'imagen' => DB::raw("REPLACE(imagen, 'uploads/libros/', 'libros/')"),
            ]);
    }
};

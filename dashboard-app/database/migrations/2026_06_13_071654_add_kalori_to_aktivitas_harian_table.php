<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aktivitas_harian', function (Blueprint $table) {
            // Menambahkan kolom kalori setelah kolom skor
            $table->integer('kalori')->default(0)->after('skor');
        });
    }

    public function down(): void
    {
        Schema::table('aktivitas_harian', function (Blueprint $table) {
            $table->dropColumn('kalori');
        });
    }
};
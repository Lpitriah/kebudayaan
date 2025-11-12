<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom foto ke tabel sanggar.
     */
    public function up(): void
    {
        Schema::table('sanggar', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('bidang_garapan_seni');
            // nullable() agar bisa kosong, sesuaikan posisi 'after' dengan kolom yang kamu mau
        });
    }

    /**
     * Hapus kolom foto jika rollback.
     */
    public function down(): void
    {
        Schema::table('sanggar', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};

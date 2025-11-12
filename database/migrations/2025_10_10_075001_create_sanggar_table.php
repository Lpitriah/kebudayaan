<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel sanggar.
     */
    public function up(): void
    {
        Schema::create('sanggar', function (Blueprint $table) {
            $table->id();

            // Data umum sanggar / komunitas
            $table->string('kode_sanggar', 20)->unique();
            $table->string('nama_sanggar', 150);
            
            // Alamat
            $table->string('jalan_rt_rw', 150)->nullable();
            $table->string('desa_kel', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();

            // SK Pembuatan
            $table->string('no_sk', 50)->nullable();
            $table->year('tahun_sk')->nullable();
            $table->string('jabatan_penandatangan', 100)->nullable();
            $table->string('nama_penandatangan', 100)->nullable();

            // Data pimpinan sanggar / komunitas
            $table->string('nama_pimpinan', 100)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('no_hp', 20)->nullable();

            // Data tambahan
            $table->integer('jumlah_anggota')->nullable();
            $table->string('bidang_garapan_seni', 150)->nullable();

            // Verifikasi & status
            $table->string('nomor_induk_kebudayaan', 50)->nullable();
            $table->enum('status', ['Menunggu', 'Terverifikasi', 'Ditolak'])->default('Menunggu');
            $table->text('keterangan_status')->nullable();

            // Relasi user yang mendaftarkan
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Hapus tabel sanggar jika dibatalkan.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanggar');
    }
};

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
        Schema::create('pelaku_budaya', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pelaku_budaya')->unique();
            $table->string('nama');
            $table->string('jenis'); // contoh: seniman, komunitas, budayawan, dll
            $table->string('kontak')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaku_budaya');
    }
};

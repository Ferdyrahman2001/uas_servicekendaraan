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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->string('deskripsi')->nullable();
            $table->string('nomor_polisi');
            $table->string('foto_kendaraan');
            $table->enum('jenis_kendaraan', ['motor', 'mobil']);
            $table->enum('status', ['pending', 'proses', 'selesai', 'batal'])->default('pending');
            $table->integer('jumlah_bayar')->default(0);
            $table->decimal('total_biaya', 15, 2)->default(0);
            $table->smallInteger('rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};

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
            $table->decimal('total_biaya', 15, 2)->default(0);
            $table->smallInteger('rating')->default(0);
            $table->unsignedBigInteger('jenis_layanan_id');
            $table->foreign('jenis_layanan_id')->references('id')->on('jenis_layanan')->onDelete('cascade');
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

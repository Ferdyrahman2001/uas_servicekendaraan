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
        Schema::create('detail_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan');
            $table->decimal('biaya', 15, 2);
            $table->foreignId('layanan_id')->constrained();
            $table->foreignId('montir_id')->constrained('montir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_layanan');
    }
};

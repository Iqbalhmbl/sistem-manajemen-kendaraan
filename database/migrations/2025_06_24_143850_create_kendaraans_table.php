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
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nomor_polisi', 20)->unique();
            $table->enum('tipe', ['angkut_orang', 'angkut_barang']);
            $table->enum('kepemilikan', ['perusahaan', 'sewa']);
            $table->string('merk', 50);
            $table->string('model', 50);
            $table->year('tahun');
            $table->uuid('region_id');
            $table->enum('status', ['aktif', 'tidak_aktif']);
            $table->timestamps();

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};

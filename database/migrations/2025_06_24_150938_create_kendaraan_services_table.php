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
        Schema::create('kendaraan_services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kendaraan_id');
            $table->date('tanggal_service');
            $table->integer('km_service');
            $table->string('jenis_service', 100);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan_services');
    }
};

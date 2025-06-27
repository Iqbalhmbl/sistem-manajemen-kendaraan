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
        Schema::create('kendaraan_usages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kendaraan_id');
            $table->uuid('booking_id');
            $table->date('tanggal');
            $table->integer('km_awal');
            $table->integer('km_akhir');
            $table->decimal('konsumsi_bbm', 8, 2);
            $table->timestamps();

            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan_usages');
    }
};

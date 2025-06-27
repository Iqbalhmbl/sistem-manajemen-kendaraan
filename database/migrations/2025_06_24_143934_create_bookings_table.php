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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('kendaraan_id');
            $table->uuid('driver_id');
            $table->dateTime('tanggal_pesan');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->text('tujuan');
            $table->enum('status', ['pending', 'approved', 'rejected', 'selesai']);
            $table->uuid('approver1_id');
            $table->uuid('approver2_id');
            $table->dateTime('approved1_at')->nullable();
            $table->dateTime('approved2_at')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('approver1_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approver2_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

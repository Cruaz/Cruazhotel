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
        Schema::create('kamar_bookeds', function (Blueprint $table) {
            $table->string('id_kamar_booked')->primary();
            $table->string('id_bookings');
            $table->foreign('id_bookings')->references('id_booking')->on('bookings')->onDelete('cascade');
            $table->integer('id_kamars');
            $table->foreign('id_kamars')->references('id_kamar')->on('kamars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_bookeds');
    }
};

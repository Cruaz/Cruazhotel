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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->string('id_pemesanan')->primary();
            $table->bigInteger('id_users')->unsigned();
            $table->foreign('id_users')->references('id_user')->on('users')->onDelete('cascade');
            $table->date('Tgl_pemesanan');
            $table->enum('Status',['Booked','Canceled','Done']);
            $table->double('total_harga');
            $table->double('diskon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};

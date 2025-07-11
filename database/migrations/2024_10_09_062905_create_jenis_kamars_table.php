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
        Schema::create('jenis_kamars', function (Blueprint $table) {
            $table->string('id_jenis')->primary();

            $table->double('harga');
            $table->integer('kapasitas');
            $table->string('nama');
            $table->string('tipe');
            $table->text('KamarOverview');
            $table->text('Deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kamars');
    }
};

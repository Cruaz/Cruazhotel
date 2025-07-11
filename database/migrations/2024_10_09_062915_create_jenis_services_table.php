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
        Schema::create('jenis_services', function (Blueprint $table) {
            $table->string('id_service')->primary();
            $table->text('deskripsi');
            $table->string('nama');
            $table->string('namaIcon');
            $table->double('harga');
            $table->boolean('tipe');
            $table->text('ServiceOverview');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_services');
    }
};

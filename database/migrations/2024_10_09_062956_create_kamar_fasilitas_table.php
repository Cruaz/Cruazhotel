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
        Schema::create('kamar_fasilitas', function (Blueprint $table) {
            $table->string('id_jeniss');
            $table->foreign('id_jeniss')->references('id_jenis')->on('jenis_kamars')->onDelete('cascade');
            $table->string('id_fasilitass');
            $table->foreign('id_fasilitass')->references('id_fasilitas')->on('fasilitas')->onDelete('cascade');
            $table->primary(['id_jeniss','id_fasilitass']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_fasilitas');
    }
};

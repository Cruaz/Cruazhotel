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
        Schema::create('kamars', function (Blueprint $table) {
            $table->integer('id_kamar')->primary();
            $table->string('id_jenises');
            $table->enum('Status',['Booked','Available','Maintenence']);
            $table->foreign('id_jenises')->references('id_jenis')->on('jenis_kamars')->onDelete('cascade');
            $table->integer('lantai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};

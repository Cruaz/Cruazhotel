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
        Schema::create('galeries', function (Blueprint $table) {
            $table->string('id_image')->primary();
            $table->string('id_jenises')->nullable();
            $table->foreign('id_jenises')->references('id_jenis')->on('jenis_kamars')->onDelete('cascade');
            $table->string('id_services')->nullable();
            $table->foreign('id_services')->references('id_service')->on('jenis_services')->onDelete('cascade');
            $table->text('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeries');
    }
};

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
        Schema::create('mahasiswa_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('item_berkas_id');
            $table->enum('status', ['0', '1']);
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('item_berkas_id')->references('id')->on('item_berkas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_berkas');
    }
};

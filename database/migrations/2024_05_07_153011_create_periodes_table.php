<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (!Schema::hasTable('periodes')) {
            if (!Schema::hasTable('template_berkas')) {
                Artisan::call('migrate', ['--path' => 'database\migrations\2024_05_07_153246_create_template_berkas_table.php']);
            }
            Schema::create('periodes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('deskripsi');
                $table->date('tgl_mulai');
                $table->date('tgl_berakhir');
                $table->unsignedBigInteger('template_berkas_id')->nullable();
                $table->enum('status', [0,1]);
                $table->timestamps();

                $table->foreign('template_berkas_id')->references('id')->on('template_berkas')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodes');
    }
};

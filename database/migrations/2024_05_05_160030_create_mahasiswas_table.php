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
        if (!Schema::hasTable('dosens')) {
           Artisan::call('migrate', ['--path' => 'database\migrations\2024_05_05_163006_create_dosens_table.php']);
        }
        if (!Schema::hasTable('periodes')) {
           Artisan::call('migrate', ['--path' => 'database\migrations\2024_05_07_153011_create_periodes_table.php']);
        }
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("dosen_id")->nullable();
            $table->string("name");
            $table->string("angkatan");
            $table->unsignedBigInteger("periode_id")->nullable();
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("dosen_id")->references("id")->on("dosens")->onDelete("cascade");
            $table->foreign("periode_id")->references("id")->on("periodes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};

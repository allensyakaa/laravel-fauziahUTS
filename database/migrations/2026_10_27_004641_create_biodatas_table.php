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
        Schema::create('biodata_1234', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('jabatan');
        $table->string('telepon');
        $table->string('instagram')->nullable();
        $table->string('email');
        $table->string('alamat');
        $table->text('tentang_saya')->nullable();
        $table->text('kesukaan')->nullable();
        $table->string('foto')->nullable();
        $table->timestamps();
    });
    }


    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};

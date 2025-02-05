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
        Schema::create('simpang', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Simpang');
            $table->string('Kota');
            $table->string('Ukuran_Kota');
            $table->date('Tanggal');
            $table->string('Periode');
            $table->string('Ditangani_Oleh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpang');
    }
};

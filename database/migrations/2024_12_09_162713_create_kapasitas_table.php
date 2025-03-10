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
        Schema::create('kapasitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Simpang')
                  ->constrained('simpang')
                  ->onDelete('cascade');
            $table->string('Kode_Pendekat');
            $table->string('Tipe_Pendekat');
            $table->float('Rasio_Kanan');
            $table->float('Rasio_Kiri');
            $table->float('Rasio_Lurus');
            $table->integer('Arus_Kanan');
            $table->integer('Lebar_Efektif');
            $table->float('Arus_Jenuh_Dasar');
            $table->float('Fcs');
            $table->float('Fsf');
            $table->float('Fg');
            $table->float('Fp');
            $table->float('Frt');
            $table->float('Flt');
            $table->float('Arus_Jenuh');
            $table->integer('Q');
            $table->float('Rasio_Arus');
            $table->float('Rasio_Fase');
            $table->float('Derajat_Kejenuhan');
            $table->float('Waktu_Hijau');
            $table->integer('Kapasitas');
            $table->float('Waktu_Siklus');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapasitas');
    }
};

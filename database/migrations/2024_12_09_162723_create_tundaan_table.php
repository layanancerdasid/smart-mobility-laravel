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
        Schema::create('tundaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Simpang')
                  ->constrained('simpang')
                  ->onDelete('cascade');
            $table->string('Kode_Pendekat');
            $table->integer('Q');
            $table->float('Derajat_Kejenuhan');
            $table->float('Rasio_Hijau');
            $table->float('NQ1');
            $table->float('NQ2');
            $table->float('N_Total');
            $table->float('NQMax');
            $table->float('Panjang_Antrian');
            $table->float('NS');
            $table->float('NSV');
            $table->float('DT');
            $table->float('DG');
            $table->float('D');
            $table->float('D_Total');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tundaan');
    }
};

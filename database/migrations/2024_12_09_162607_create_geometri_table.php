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
        Schema::create('geometri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Simpang')
                  ->constrained('simpang')
                  ->onDelete('cascade');
            $table->string('Kode_Pendekat');
            $table->string('Tipe_Lingkungan');
            $table->string('Kelas_Hambatan');
            $table->string('Median');
            $table->string('Kelandaian');
            $table->string('Belok_Kiri');
            $table->string('Jarak_Kendaraan_Parkir');
            $table->float('Lebar_Pendekat_Awal');
            $table->float('Lebar_Pendekat_Garis');
            $table->float('Lebar_Pendekat_Belok');
            $table->float('Lebar_Pendekat_Keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geometri');
    }
};

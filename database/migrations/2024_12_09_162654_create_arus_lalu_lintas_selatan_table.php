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
        Schema::create('arus_lalu_lintas_selatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Simpang')
                  ->constrained('simpang')
                  ->onDelete('cascade');
            $table->string('Tipe_Pendekat');
            $table->string('Arah');
            $table->integer('MC');
            $table->integer('LV');
            $table->integer('HV');
            $table->integer('UM');
            $table->timestamp('Waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arus_lalu_lintas_selatan');
    }
};

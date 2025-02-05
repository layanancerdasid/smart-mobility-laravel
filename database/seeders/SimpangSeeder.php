<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SimpangSeeder extends Seeder
{
    public function run(): void
    {
        $simpang = [];
        
        // Generate 100 simpang records
        for ($i = 1; $i <= 100; $i++) {
            $simpang[] = [
                'id' => $i,
                'Nama_Simpang' => 'Simpang ' . $i,
                'Kota' => 'Kota Sample',
                'Ukuran_Kota' => 'Sedang',
                'Tanggal' => now(),
                'Periode' => 'Pagi',
                'Ditangani_Oleh' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert in chunks
        collect($simpang)->chunk(50)->each(function($chunk) {
            DB::table('simpang')->insert($chunk->toArray());
        });
    }
}
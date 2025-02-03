<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArusUtaraSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/ARUS_LALU_LINTAS_UTARA.json');
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        $data = collect($jsonData)->map(function ($item) {
            return [
                'ID_Simpang' => $item['ID_Simpang'],
                'Tipe_Pendekat' => $item['Tipe_Pendekat'],
                'Arah' => strtolower($item['arah']),
                'MC' => $item['MC'],
                'LV' => $item['LV'], 
                'HV' => $item['HV'],
                'UM' => $item['UM'],
                'Waktu' => Carbon::createFromFormat('d-m-Y H:i:s', $item['timestamp']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        collect($data)->chunk(100)->each(function ($chunk) {
            DB::table('arus_lalu_lintas_utara')->insert($chunk->toArray());
        });
    }
}
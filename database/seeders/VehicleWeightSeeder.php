<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleWeightSeeder extends Seeder
{
    public function run()
    {
        DB::table('vehicle_weight')->insertOrIgnore([
            ['vehicle_type' => 'MC', 'weight' => 0.2],
            ['vehicle_type' => 'LV', 'weight' => 1.0],
            ['vehicle_type' => 'HV', 'weight' => 1.3],
            ['vehicle_type' => 'UM', 'weight' => 0.0],
        ]);
    }
}

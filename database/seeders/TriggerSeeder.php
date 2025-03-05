<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TriggerSeeder extends Seeder
{
    public function run()
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION update_traffic_volume()
            RETURNS TRIGGER AS $$
            BEGIN
                INSERT INTO traffic_volume (direction, approach_type, movement_type, vehicle_type, volume, recorded_at)
                VALUES 
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KIRI', 'MC', NEW.\"MC\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KIRI', 'LV', NEW.\"LV\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KIRI', 'HV', NEW.\"HV\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KIRI', 'UM', NEW.\"UM\", NEW.\"Waktu\"),

                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'LURUS', 'MC', NEW.\"MC\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'LURUS', 'LV', NEW.\"LV\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'LURUS', 'HV', NEW.\"HV\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'LURUS', 'UM', NEW.\"UM\", NEW.\"Waktu\"),

                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KANAN', 'MC', NEW.\"MC\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KANAN', 'LV', NEW.\"LV\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KANAN', 'HV', NEW.\"HV\", NEW.\"Waktu\"),
                    (NEW.\"Arah\", NEW.\"Tipe_Pendekat\", 'KANAN', 'UM', NEW.\"UM\", NEW.\"Waktu\");
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        DB::unprepared("
            CREATE OR REPLACE TRIGGER trigger_update_traffic_volume_barat
            AFTER INSERT ON arus_lalu_lintas_barat
            FOR EACH ROW EXECUTE FUNCTION update_traffic_volume();
        ");

        DB::unprepared("
            CREATE OR REPLACE TRIGGER trigger_update_traffic_volume_timur
            AFTER INSERT ON arus_lalu_lintas_timur
            FOR EACH ROW EXECUTE FUNCTION update_traffic_volume();
        ");

        DB::unprepared("
            CREATE OR REPLACE TRIGGER trigger_update_traffic_volume_selatan
            AFTER INSERT ON arus_lalu_lintas_selatan
            FOR EACH ROW EXECUTE FUNCTION update_traffic_volume();
        ");

        DB::unprepared("
            CREATE OR REPLACE TRIGGER trigger_update_traffic_volume_utara
            AFTER INSERT ON arus_lalu_lintas_utara
            FOR EACH ROW EXECUTE FUNCTION update_traffic_volume();
        ");
    }
}

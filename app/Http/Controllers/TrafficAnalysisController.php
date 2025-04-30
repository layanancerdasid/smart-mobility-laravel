<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class TrafficAnalysisController extends Controller
{
    public function index()
    {
        $results = DB::select("
            SELECT waktu_puncak, arah_masuk, SUM(total_IN) AS total_IN
            FROM (
                SELECT
                    CASE
                        WHEN HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) BETWEEN 6 AND 8 THEN 'Morning'
                        WHEN HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) BETWEEN 12 AND 13 THEN 'Day'
                        WHEN (
                            HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) = 16 AND MINUTE(CONVERT_TZ(waktu, '+00:00', '+07:00')) >= 45
                        ) OR (
                            HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) = 17 AND MINUTE(CONVERT_TZ(waktu, '+00:00', '+07:00')) <= 45
                        ) THEN 'Evening'
                        ELSE NULL
                    END AS waktu_puncak,
                    dari_arah AS arah_masuk,
                    CASE
                        WHEN (ID_Simpang = 5 AND dari_arah = 'north') THEN 1
                        WHEN (ID_Simpang = 2 AND dari_arah = 'east') THEN 1
                        WHEN (ID_Simpang = 4 AND dari_arah = 'east') THEN 1
                        WHEN (ID_Simpang = 3 AND dari_arah = 'west') THEN 1
                        ELSE 0
                    END AS total_IN
                FROM arus
                WHERE DATE(CONVERT_TZ(waktu, '+00:00', '+07:00')) = DATE(CONVERT_TZ(NOW() - INTERVAL 1 DAY, '+00:00', '+07:00'))
                AND (
                    (HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) BETWEEN 6 AND 8) OR
                    (HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) BETWEEN 12 AND 13) OR
                    (HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) = 16 AND MINUTE(CONVERT_TZ(waktu, '+00:00', '+07:00')) >= 45) OR
                    (HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) = 17 AND MINUTE(CONVERT_TZ(waktu, '+00:00', '+07:00')) <= 45)
                )
            ) AS sub
            WHERE waktu_puncak IS NOT NULL
            GROUP BY waktu_puncak, arah_masuk
        ");

        return response()->json($results);
    }

    public function intersection()
    {
        $results = DB::select("
        SELECT
            waktu_puncak,
            dari_arah AS arm,
            SUM(kendaraan) AS `Saturation (vehicle/hour)`,
            ROUND(SUM(kendaraan) / 6000, 3) AS `Flow Ratio`, -- contoh pembagi kapasitas
            120 AS `Cycle time(s)`, -- fixed example
            25 AS `Green Time(s)`,  -- fixed example
            750 AS `Capacity (vehicle/hour)` -- fixed example
        FROM (
            SELECT
            CASE
                WHEN HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) BETWEEN 6 AND 8 THEN 'Morning (07.00-08.00)'
                WHEN HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) BETWEEN 12 AND 13 THEN 'Day (12.00-13.00)'
                WHEN (
                HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) = 16 AND MINUTE(CONVERT_TZ(waktu, '+00:00', '+07:00')) >= 45
                ) OR (
                HOUR(CONVERT_TZ(waktu, '+00:00', '+07:00')) = 17 AND MINUTE(CONVERT_TZ(waktu, '+00:00', '+07:00')) <= 45
                ) THEN 'Evening (16.45-17.45)'
                ELSE NULL
            END AS waktu_puncak,
            dari_arah,
            (SM + MP + AUP + TR + BS + TS + TB + BB + GANDENG + KTB) AS kendaraan
            FROM arus
            WHERE DATE(CONVERT_TZ(waktu, '+00:00', '+07:00')) = DATE(CONVERT_TZ(NOW() - INTERVAL 1 DAY, '+00:00', '+07:00'))
        ) AS traffic
        WHERE waktu_puncak IS NOT NULL
        GROUP BY waktu_puncak, dari_arah
        ORDER BY waktu_puncak, dari_arah;
      
        ");

        return response()->json($results);
    }

    public function top5(Request $request)
    {
        $date = $request->query('date');

        $data = DB::table('arus')
            ->select('id', 'ID_Simpang', 'tipe_pendekat', 'dari_arah', 'ke_arah', 'SM', 'MP', 'AUP', 'TR', 'waktu')
            ->whereDate(DB::raw("CONVERT_TZ(waktu, '+00:00', '+07:00')"), $date)
            ->orderBy('waktu', 'asc')
            ->limit(5)
            ->get();

        return response()->json($data);
    }

}

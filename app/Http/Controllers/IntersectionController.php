<?php
namespace App\Http\Controllers;

use App\Models\Intersection;
use Illuminate\Http\Request;

class IntersectionController extends Controller
{
    public function index()
    {
        return view('intersections.index');
    }

    public function create()
    {
        return view('intersections.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Nama_Simpang' => 'required|min:3',
            'Kota' => 'required',
            'Ukuran_Kota' => 'nullable',
            'Tanggal' => 'nullable|date',
            'Periode' => 'nullable',
            'Ditangani_Oleh' => 'nullable'
        ]);

        Intersection::create($validatedData);
        return redirect()->route('intersections.index')->with('success', 'Simpang berhasil ditambahkan');
    }

    public function tutorial() {
        return view('livewire.tutorial.index');
    }

    public function simulator() {
        $evaluationData = [
            [
                'time' => 'Morning (07.00-08.00)',
                'data' => [
                    ['arm' => 'North', 'saturation' => 0.08, 'queue_length' => 22.68, 'stopped_vehicles' => 26.23, 'delay' => 42.01, 'los' => 'E'],
                    ['arm' => 'East', 'saturation' => 0.59, 'queue_length' => 80.21, 'stopped_vehicles' => 361.74, 'delay' => 47.25, 'los' => 'E'],
                    ['arm' => 'South', 'saturation' => 0.19, 'queue_length' => 33.21, 'stopped_vehicles' => 91.52, 'delay' => 43.21, 'los' => 'E'],
                    ['arm' => 'West', 'saturation' => 0.53, 'queue_length' => 71.68, 'stopped_vehicles' => 318.77, 'delay' => 45.85, 'los' => 'E'],
                ]
            ],
            [
                'time' => 'Day (12.00-13.00)',
                'data' => [
                    ['arm' => 'North', 'saturation' => 0.16, 'queue_length' => 32.72, 'stopped_vehicles' => 56.59, 'delay' => 42.83, 'los' => 'E'],
                    ['arm' => 'East', 'saturation' => 0.93, 'queue_length' => 156.81, 'stopped_vehicles' => 747.59, 'delay' => 75.84, 'los' => 'F'],
                    ['arm' => 'South', 'saturation' => 0.20, 'queue_length' => 33.54, 'stopped_vehicles' => 92.86, 'delay' => 43.44, 'los' => 'E'],
                    ['arm' => 'West', 'saturation' => 0.85, 'queue_length' => 130.08, 'stopped_vehicles' => 612.94, 'delay' => 60.15, 'los' => 'F'],
                ]
            ],
            [
                'time' => 'Evening (16.45-17.45)',
                'data' => [
                    ['arm' => 'North', 'saturation' => 0.15, 'queue_length' => 30.22, 'stopped_vehicles' => 49.03, 'delay' => 42.48, 'los' => 'E'],
                    ['arm' => 'East', 'saturation' => 0.76, 'queue_length' => 108.31, 'stopped_vehicles' => 503.29, 'delay' => 53.80, 'los' => 'E'],
                    ['arm' => 'South', 'saturation' => 0.18, 'queue_length' => 31.45, 'stopped_vehicles' => 84.41, 'delay' => 43.30, 'los' => 'E'],
                    ['arm' => 'West', 'saturation' => 0.80, 'queue_length' => 119.12, 'stopped_vehicles' => 557.75, 'delay' => 56.03, 'los' => 'E'],
                ]
            ],
        ];
        return view('livewire.simulator.index', compact('evaluationData'));
    }

    public function check() {
        return view('livewire.simulator.check');
    }
}
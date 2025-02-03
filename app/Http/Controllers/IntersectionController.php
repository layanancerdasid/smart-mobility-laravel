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
}
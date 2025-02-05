<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tundaan extends Model
{
    protected $table = 'tundaan';
    
    protected $fillable = [
        'ID_Simpang', 'Kode_Pendekat', 'Q', 'Derajat_Kejenuhan',
        'Rasio_Hijau', 'NQ1', 'NQ2', 'N_Total', 'NQMax',
        'Panjang_Antrian', 'NS', 'NSV', 'DT', 'DG', 'D', 'D_Total'
    ];

    public function simpang()
    {
        return $this->belongsTo(Simpang::class, 'ID_Simpang');
    }
}
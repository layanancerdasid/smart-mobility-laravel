<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kapasitas extends Model
{
    protected $table = 'kapasitas';
    
    protected $fillable = [
        'ID_Simpang', 'Kode_Pendekat', 'Tipe_Pendekat', 'Rasio_Kanan',
        'Rasio_Kiri', 'Rasio_Lurus', 'Arus_Kanan', 'Lebar_Efektif',
        'Arus_Jenuh_Dasar', 'Fcs', 'Fsf', 'Fg', 'Fp', 'Frt', 'Flt',
        'Arus_Jenuh', 'Q', 'Rasio_Arus', 'Rasio_Fase', 'Derajat_Kejenuhan',
        'Waktu_Hijau', 'Kapasitas', 'Waktu_Siklus'
    ];

    public function simpang()
    {
        return $this->belongsTo(Simpang::class, 'ID_Simpang');
    }
}
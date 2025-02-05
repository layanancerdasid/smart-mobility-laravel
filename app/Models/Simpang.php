<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpang extends Model
{
    protected $table = 'simpang';
    // protected $primaryKey = 'ID_Simpang';
    
    protected $fillable = [
        'Nama_Simpang', 
        'Kota', 
        'Ukuran_Kota', 
        'Tanggal', 
        'Periode', 
        'Ditangani_Oleh'
    ];
    // public function geometri()
    // {
    //     return $this->hasMany(Geometri::class, 'ID_Simpang');
    // }

    // public function kapasitas()
    // {
    //     return $this->hasMany(Kapasitas::class, 'ID_Simpang', 'ID_Simpang');
    // }

    // public function tundaan()
    // {
    //     return $this->hasMany(Tundaan::class, 'ID_Simpang', 'ID_Simpang');
    // }

    // public function arusLaluLintasTimur()
    // {
    //     return $this->hasMany(ArusLaluLintasTimur::class, 'ID_Simpang');
    // }

    // public function arusLaluLintasUtara()
    // {
    //     return $this->hasMany(ArusLaluLintasUtara::class, 'ID_Simpang');
    // }

    // public function arusLaluLintasBarat()
    // {
    //     return $this->hasMany(ArusLaluLintasBarat::class, 'ID_Simpang');
    // }

    // public function arusLaluLintasSelatan()
    // {
    //     return $this->hasMany(ArusLaluLintasSelatan::class, 'ID_Simpang');
    // }

    public function geometries()
    {
        return $this->hasMany(Geometri::class, 'id', 'id_Simpang');
    }

    public function trafficFlows()
    {
        return $this->hasMany(TrafficFlow::class, 'id', 'id_Simpang');
    }
}
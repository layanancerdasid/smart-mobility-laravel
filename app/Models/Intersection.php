<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intersection extends Model
{
    protected $table = 'simpang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'Nama_Simpang', 
        'Kota', 
        'Ukuran_Kota', 
        'Tanggal', 
        'Periode', 
        'Ditangani_Oleh'
    ];

    public function geometries()
    {
        return $this->hasMany(Geometri::class, 'simpang_id', 'id');
    }

    public function trafficFlows()
    {
        return $this->hasMany(TrafficFlow::class, 'simpang_id', 'id');
    }
}
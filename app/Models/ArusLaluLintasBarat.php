<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArusLaluLintasBarat extends Model
{
    protected $table = 'arus_lalu_lintas_barat';
    protected $fillable = [
        'ID_Simpang', 'Tipe_Pendekat', 'Arah', 'MC', 'LV', 'HV',
        'UM', 'Waktu'
    ];

    public function simpang()
    {
        return $this->belongsTo(Simpang::class, 'ID_Simpang');
    }
}
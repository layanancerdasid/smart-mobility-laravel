<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'url',
        'thumbnail_url',
        'location',
        'resolution',
        'status',
    ];
}

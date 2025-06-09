<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'tempat_lahir',
        'agama', 'alamat', 'tanggal_kematian', 'waktu_kematian',
        'tempat_kematian', 'sebab_kematian', 'pendidikan', 'profesi',
        'ayah', 'ibu'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_kematian' => 'date',
        'waktu_kematian' => 'datetime',
    ];
}

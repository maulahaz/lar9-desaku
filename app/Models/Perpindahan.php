<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpindahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'alamat_asal',
        'alamat_tujuan',
        'tanggal_perpindahan',
        'jenis_perpindahan',
        'sebab_perpindahan',
    ];
}

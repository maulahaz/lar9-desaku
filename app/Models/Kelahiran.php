<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use HasFactory;

    protected $table = 'kelahirans';

    protected $fillable = [
        'tempat_lahir',
        'tanggal_lahir',
        'jam_lahir',
        'nama',
        'jenis_kelamin',
        'panjang',
        'berat',
        'ayah',
        'ibu',
        'anak_ke',
        'jenis_kelahiran',
        'penolong_kelahiran',
    ];
}

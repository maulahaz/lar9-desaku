<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduks';

    // protected $fillable = [
    //     'nik',
    //     'nama',
    //     'tempat_lahir',
    //     'tanggal_lahir',
    //     'jenis_kelamin',
    //     'agama',
    //     'pendidikan',
    //     'profesi',
    //     'alamat',
    //     'email'
    // ];
}
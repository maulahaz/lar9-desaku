<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false; // Nonaktifkan timestamps

    protected $fillable = [
        'name',
        'description',
    ];

    //--Relasi ke User (many-to-many)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
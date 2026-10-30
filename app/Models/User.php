<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_pengguna';

    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'nik',
        'nama_pengguna',
        'password',
        'nama',
        'no_telepon',
        'role',
        'foto',
        'is_delete',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'id_pengguna' => 'int',
    ];

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function getUsernameAttribute()
    {
        return $this->attributes['nama_pengguna'] ?? null;
    }

    public function getIdAttribute()
    {
        return $this->attributes['id_pengguna'] ?? null;
    }

    public function getNameAttribute()
    {
        return $this->attributes['nama'] ?? null;
    }

    public function getPictureAttribute()
    {
        return $this->attributes['foto'] ?? null;
    }

    public function getEmailAttribute()
    {
        return $this->attributes['email'] ?? null;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
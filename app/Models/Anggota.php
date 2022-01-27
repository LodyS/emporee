<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Anggota extends Authenticatable
{
    use HasFactory;

    protected $table = 'anggota';
    protected $fillable = ['kode_anggota', 'username', 'no_telepon', 'email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeKodeAnggota ()
    {
        $kode_anggota = Anggota::selectRaw('CONCAT("MEM-", substr(kode_anggota,5)+1) as kode_anggota')
        ->where('kode_anggota', 'like', 'MEM-%')
        ->orderByDesc('id')
        ->first();

        return $kode_anggota->kode_anggota ?? 'MEM-1';
    }
}

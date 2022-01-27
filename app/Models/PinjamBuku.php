<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamBuku extends Model
{
    use HasFactory;

    protected $table = 'pinjam_buku';
    protected $fillable = ['buku_id', 'anggota_id', 'admin_id', 'tanggal_pinjam', 'tanggal_pengembalian', 'status', 'jumlah_buku'];
    protected $primaryKey = 'id';
}

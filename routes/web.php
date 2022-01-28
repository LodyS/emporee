<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/anggota', [LoginController::class,'showAnggotaLoginForm']);
Route::get('/register/anggota', [RegisterController::class,'showAnggotaRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/anggota', [LoginController::class,'anggotaLogin']);
Route::post('/register/anggota', [RegisterController::class,'createAnggota']);

Route::group(['middleware' => 'auth:anggota'], function () {
    Route::view('/anggota', 'anggota');
});

Route::group(['middleware' => 'auth:admin'], function () {

    Route::view('/admin', 'admin');
    // buku
    Route::get('buku/index', [BukuController::class, 'index']);
    Route::post('simpan-buku', [BukuController::class, 'store']);
    Route::post('hapus-buku', [BukuController::class, 'destroy']);
    Route::post('edit-buku', [BukuController::class, 'edit']);


    Route::get('anggota/index', [AnggotaController::class, 'index']);
    Route::post('simpan-anggota', [AnggotaController::class, 'store']);
    Route::post('hapus-anggota', [AnggotaController::class, 'destroy']);
    Route::post('edit-anggota', [AnggotaController::class, 'edit']);

    // pinjam buku
    Route::get('pinjam-buku/index', [PinjamBukuController::class, 'index']);
    Route::post('approve', [PinjamBukuController::class, 'approve']);
    Route::post('reject', [PinjamBukuController::class, 'reject']);
    Route::get('pinjam-buku/pengembalian-pinjam-buku', [PinjamBukuController::class, 'pengembalianPinjamanBuku']);
    Route::post('pengembalian-buku', [PinjamBukuController::class, 'pengembalianBuku']);

});
Route::get('pinjam-buku/cari-stok-buku/{buku_id}', [PinjamBukuController::class, 'stokbuku'])->name('cari-stok-buku');
Route::post('simpan-pengajuan-buku', [PinjamBukuController::class, 'store']);
Route::get('list-buku', [PinjamBukuController::class, 'listbuku']);
Route::get('pinjam-buku', [PinjamBukuController::class, 'pengajuanPinjamBuku']);
Route::get('list-pinjam-buku', [PinjamBukuController::class, 'listPinjamBuku']);
Route::get('buku/cek-kode-buku/{kode_buku}', [BukuController::class, 'cekKodeBuku'])->name('cek-kode-buku');

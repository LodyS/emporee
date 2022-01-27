<?php

namespace App\Http\Controllers;
use App\Models\PinjamBuku;
use App\Models\Buku;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests\PinjamBukuRequest;

class PinjamBukuController extends Controller
{
    public function index ()
    {
        return view ('pinjam-buku/index');
    }

    public function pengembalianPinjamanBuku()
    {
        return view ('pinjam-buku/pengembalian-pinjam-buku');
    }

    public function listbuku ()
    {
        $buku = PinjamBuku::select('buku.judul_buku', 'status', 'tanggal_pinjam', 'tanggal_pengembalian', 'jumlah_buku')
        ->join('buku', 'buku.id', 'pinjam_buku.buku_id')
        ->where('anggota_id', Auth::guard('anggota')->user()->id)
        ->where('status', '<>', 'Menunggu persetujuan');

        if(request()->ajax()) {
            return datatables()->of($buku)
            ->addColumn('action', 'pengajuan-pinjam-buku')
            ->rawColumns(['action'])
            ->addColumn('tanggal_pinjam', function($row){
                $tanggal_pinjam = date('d-m-Y', strtotime($row->tanggal_pinjam));
                return $tanggal_pinjam;
            })
            ->addColumn('tanggal_pengembalian', function($row){
                $tanggal_pengembalian = date('d-m-Y', strtotime($row->tanggal_pengembalian));
                return $tanggal_pengembalian;
            })
            ->addIndexColumn()
            ->make(true);
        }
    } // untuk guard anggota

    public function pengajuanPinjamBuku ()
    {
        $pinjamBuku = PinjamBuku::select('pinjam_buku.id','buku.judul_buku', 'status', 'tanggal_pinjam', 'tanggal_pengembalian', 'anggota.username')
        ->join('buku', 'buku.id', 'pinjam_buku.buku_id')
        ->join('anggota', 'anggota.id', 'pinjam_buku.anggota_id')
        ->where('status', 'Menunggu persetujuan');

        if(request()->ajax()) {
            return datatables()->of($pinjamBuku)
            ->addColumn('action', 'pinjam-buku/index-action')
            ->rawColumns(['action'])
            ->addColumn('tanggal_pinjam', function($row){
                $tanggal_pinjam = date('d-m-Y', strtotime($row->tanggal_pinjam));
                return $tanggal_pinjam;
            })
            ->addColumn('tanggal_pengembalian', function($row){
                $tanggal_pengembalian = date('d-m-Y', strtotime($row->tanggal_pengembalian));
                return $tanggal_pengembalian;
            })
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function store (PinjamBukuRequest $request)
    {
        DB::beginTransaction();

        try {

            $buku = Buku::select('stok_buku')->where('id', $request->buku_id)->first();

            if ($request->jumlah_buku > $buku->stok_buku)
            {
                $pesan = 'Stok pinjam melebihi stok buku';
                return response()->json($pesan);
            }

            $simpan = PinjamBuku::create($request->all());
            DB::commit();
            return response()->json($simpan);
        } catch (\Illuminate\Database\QueryException $e){
            DB::rollback();
            return back()->withError('Gagal simpan data');
        }
    }

    public function stokbuku($buku_id)
    {
        $data = Buku::select('stok_buku')->where('id',$buku_id)->first();
        echo json_encode($data);
        exit;
    }

    public function approve (Request $request)
    {
        $approve = PinjamBuku::find($request->id);
        $jumlah_buku = $approve->jumlah_buku;
        $buku_id = $approve->buku_id;

        $update = $approve->update(['status'=>'Approve', 'admin_id'=>Auth::guard('admin')->user()->id]);
        Buku::where('id', $buku_id)->decrement('stok_buku', $jumlah_buku);

        return response()->json($update);
    }

    public function reject (Request $request)
    {
        $reject = PinjamBuku::find($request->id)->update(['status'=>'Reject', 'admin_id'=>Auth::guard('admin')->user()->id]);
        return response()->json($reject);
    }

    public function listPinjamBuku ()
    {
        $pinjamBuku = PinjamBuku::select('pinjam_buku.id','buku.judul_buku', 'status', 'tanggal_pinjam', 'tanggal_pengembalian', 'anggota.username')
        ->join('buku', 'buku.id', 'pinjam_buku.buku_id')
        ->join('anggota', 'anggota.id', 'pinjam_buku.anggota_id')
        ->where('status', 'Approve');

        if(request()->ajax()) {
            return datatables()->of($pinjamBuku)
            ->addColumn('action', 'pinjam-buku/pengembalian-pinjam-buku-action')
            ->rawColumns(['action'])
            ->addColumn('tanggal_pinjam', function($row){
                $tanggal_pinjam = date('d-m-Y', strtotime($row->tanggal_pinjam));
                return $tanggal_pinjam;
            })
            ->addColumn('tanggal_pengembalian', function($row){
                $tanggal_pengembalian = date('d-m-Y', strtotime($row->tanggal_pengembalian));
                return $tanggal_pengembalian;
            })
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function pengembalianBuku(Request $request)
    {
        $pinjamBuku = PinjamBuku::find($request->id);
        $jumlah_buku = $pinjamBuku->jumlah_buku;
        $buku_id = $pinjamBuku->buku_id;

        $pengembalianBuku = $pinjamBuku->update(['status'=>'Sudah Dikembalikan']);
        Buku::where('id', $buku_id)->increment('stok_buku', $buku_id);

        return response()->json($pengembalianBuku);
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::select('id', 'kode_buku', 'judul_buku', 'tahun_terbit', 'penulis_buku', 'stok_buku');

        if(request()->ajax()) {
            return datatables()->of($buku)
            ->addColumn('action', 'buku/buku-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('buku/index');
    }

    public function cekKodeBuku ($kode_buku)
    {
        $data = Buku::selectRaw('CASE WHEN COUNT(id) >= 1 THEN "Ada" ELSE "Tidak Ada" END AS status')->where('kode_buku', $kode_buku)->first();

        echo json_encode($data);
        exit;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_buku'=>'required|string|',
            'judul_buku'=>'required|string',
            'tahun_terbit'=>'required|integer|digits:4',
            'penulis_buku'=>'required|string',
            'stok_buku'=>'required|integer'
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $buku = Buku::updateOrCreate(['id' => $request->id],[
            'judul_buku'=>$request->judul_buku,
            'kode_buku'=>$request->kode_buku,
            'tahun_terbit'=>$request->tahun_terbit,
            'penulis_buku'=>$request->penulis_buku,
            'stok_buku'=>$request->stok_buku
        ]);

        return Response()->json($buku);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $buku  = Buku::where($where)->first();

        return Response()->json($buku);
    }

    public function destroy(Request $request)
    {
        $buku = Buku::where('id',$request->id)->delete();

        return Response()->json($buku);
    }
}

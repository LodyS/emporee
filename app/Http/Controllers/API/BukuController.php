<?php

namespace App\Http\Controllers\API;
use App\Models\Buku;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index ()
    {
        $buku = Buku::toBase()->get();

        return response()->json(['message'=>'Data buku','data'=>$buku], 200);
    }

    public function show($id)
    {
        $buku = Buku::find($id)->first();

        if ($buku)
        {
            return response()->json(['message'=>'Data Buku', 'data'=>$buku],200);
        } else {
            return response()->json(['message'=>'Data Buku tidak ditemukan',],404);
        }

    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_buku'=>'required|string|unique:buku',
            'judul_buku'=>'required|string',
            'tahun_terbit'=>'required|integer|digits:4',
            'penulis_buku'=>'required|string',
            'stok_buku'=>'required|integer'
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $buku = Buku::create($request->all());

        if ($buku)
        {
            return response()->json(['message'=>'Berhasil simpan data buku'],201);
        } else {
            return response()->json(['message'=>'Gagal simpan data buku'],409);
        }
    }

    public function update (Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'kode_buku'=>'string|unique:buku',
            'judul_buku'=>'string',
            'tahun_terbit'=>'integer|digits:4',
            'penulis_buku'=>'string',
            'stok_buku'=>'integer'
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $buku = Buku::find($id);

        if ($buku)
        {
            $buku->update($request->all());
            return response()->json(['message'=>'Berhasil update data buku'],200);

        } else {
            return response()->json(['message'=>'Buku tidak ditemukan']);
        }
    }

    public function destroy ($id)
    {
        $buku = Buku::find($id);

        if ($buku)
        {
            $buku->delete();
            return response()->json(['message'=>'Berhasil hapus buku'],200);
        } else {
            return response()->json(['message'=>'Gagal hapus buku']);
        }
    }
}

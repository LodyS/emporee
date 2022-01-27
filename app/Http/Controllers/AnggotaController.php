<?php

namespace App\Http\Controllers;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Datatables;
use DB;
use App\Http\Requests\AnggotaRequest;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $kode_anggota = Anggota::kodeAnggota();
        $anggota = Anggota::select('*');

        if(request()->ajax()) {
            return datatables()->of($anggota)
            ->addColumn('action', 'anggota/anggota-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('anggota/index', compact('kode_anggota'));
    }

    public function store(AnggotaRequest $request)
    {
        $anggota = Anggota::updateOrCreate(['id' => $request->id],[
            'kode_anggota'=>$request->kode_anggota,
            'username'=>$request->username,
            'no_telepon'=>$request->no_telepon,
            'email'=>$request->email,
            'password'=>Hash::make('password'),
        ]);

        return Response()->json($anggota);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $anggota  = Anggota::where($where)->first();

        return Response()->json($anggota);
    }

    public function destroy(Request $request)
    {
        $anggota = Anggota::where('id',$request->id)->delete();

        return Response()->json($anggota);
    }
}

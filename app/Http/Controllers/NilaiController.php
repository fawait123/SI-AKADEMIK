<?php

namespace App\Http\Controllers;

use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    //
    public function inputNilai(Request $request)
    {
        $cari = false;
        $mapel = Mapel::where('id_guru',auth()->user()->modelID)->get();
        $data = [];
        if($request->filled('id_mapel')){
            $cari = true;
            $cariMapel = Mapel::where('id_mapel',$request->id_mapel)->first();
            $whereIn = KelasSiswa::where('nama_kelas',$cariMapel->nama_kelas)->pluck('id_siswa')->toArray();
            $data = Siswa::whereIn('id_siswa',$whereIn)->get();
        }
        return view('nilai.input',compact('mapel','cari','data'));
    }

    public function storeNilai(Request $request)
    {
        $id_siswa = $request->id_siswa;
        $uh1 = $request->uh1;
        $uh2 = $request->uh2;
        $uh3 = $request->uh3;
        $uts = $request->uts;
        $uas = $request->uas;

        $mapel = Mapel::where('id_mapel',$request->id_mapel)->first();
        $tahun = TahunAkademik::where('status','aktif')->first();

        for ($i=0; $i<count($id_siswa); $i++){
            Nilai::create([
                'id_siswa'=>$id_siswa[$i],
                'uh1'=>$uh1[$i],
                'uh2'=>$uh2[$i],
                'uh3'=>$uh3[$i],
                'uts'=>$uts[$i],
                'uas'=>$uas[$i],
                'nama_kelas'=>$mapel->nama_kelas,
                'id_mapel'=>$request->id_mapel,
                'id_tahun'=>$tahun->id_tahun,
            ]);
        }

        return redirect()->route('list.nilai')->with(['message'=>'Data nilai berhasil ditambahkan']);
    }

    public function listNilai(Request $request)
    {
        dd('nilai');
    }
}

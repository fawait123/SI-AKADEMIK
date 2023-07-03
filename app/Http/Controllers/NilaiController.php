<?php

namespace App\Http\Controllers;

use App\Helpers\Kelas;
use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Models\WaliKelas;
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
        $mapel = [];
        $datas = collect([]);

        if(auth()->user()->namespace == '\App\Models\Guru'){
            $mapel = Mapel::where('id_guru',auth()->user()->modelID)->get();
        }else if(auth()->user()->namespace == '\App\Models\Siswa'){
            $tahunAkademik = TahunAkademik::where('status','aktif')->first();
            $kelasSiswa = KelasSiswa::where('id_siswa',auth()->user()->modelID)->where('id_tahun',$tahunAkademik->id_tahun)->pluck('nama_kelas')->toArray();
            $mapel = Mapel::whereIn('nama_kelas',$kelasSiswa)->get();
        }else if(auth()->user()->namespace == '\App\Models\WaliKelas'){
            $wali = WaliKelas::where('id_wali',auth()->user()->modelID)->pluck('nama_kelas')->toArray();
            $mapel = Mapel::whereIn('nama_kelas',$wali)->get();
        }


        if($request->filled('id_mapel')){
            $cariMapel = Mapel::where('id_mapel',$request->id_mapel)->first();
            $kelasSiswa = KelasSiswa::where('nama_kelas',$cariMapel->nama_kelas)->pluck('id_siswa')->toArray();
            $cariTahun = TahunAkademik::where('status','aktif')->first();
            $getSiswa = Siswa::query();
            if(auth()->user()->namespace == "\App\Models\Siswa"){
                $getSiswa = $getSiswa->where('id_siswa',auth()->user()->modelID);
            }
            $getSiswa = $getSiswa->whereIn('id_siswa',$kelasSiswa);
            $getSiswa = $getSiswa->get();

            foreach ($getSiswa as $item){
                $carNilai = Nilai::where('id_siswa',$item->id_siswa)->where('id_tahun',$cariTahun->id_tahun)->where('id_mapel',$cariMapel->id_mapel)->first();
                $uh1 = $carNilai->uh1 ?? 0;
                $uh2 = $carNilai->uh2 ?? 0;
                $uh3 = $carNilai->uh3 ?? 0;
                $uts = $carNilai->uts ?? 0;
                $uas = $carNilai->uas ?? 0;
                $rata_rata = ($uh1 + $uh2 + $uh3 + $uts + $uas) / 5;
                $datas->push([
                    'nama'=>$item->nisn.' '.$item->nama,
                    'uh1'=>$carNilai->uh1 ?? 0,
                    'uh2'=>$carNilai->uh2 ?? 0,
                    'uh3'=>$carNilai->uh3 ?? 0,
                    'uts'=>$carNilai->uts ?? 0,
                    'uas'=>$carNilai->uas ?? 0,
                    'rata_rata'=>$rata_rata
                ]);
            }
        }

        return view('nilai.list',compact('mapel','datas'));
    }
}

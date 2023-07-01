<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Mapel::with(['guru','tahun'])->latest()->get();
        return view('mapel.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $guru = Guru::get();
        $tahun = TahunAkademik::get();
        return view('mapel.form',compact('guru','tahun'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'id_guru'=>'required',
            'id_tahun'=>'required',
            'mapel'=>'required',
            'nama_kelas'=>'required'
        ]);

        Mapel::create($request->all());

        return redirect()->route('mapel.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        //
        $id = $mapel->id_mapel;
        $guru = Guru::get();
        $tahun = TahunAkademik::get();
        return view('mapel.form',compact('guru','tahun','id','mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mapel $mapel)
    {
        //

        $request->validate([
            'id_guru'=>'required',
            'id_tahun'=>'required',
            'mapel'=>'required',
            'nama_kelas'=>'required'
        ]);

        $mapel->update($request->all());

        return redirect()->route('mapel.index')->with(['message'=>'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        //
        $mapel->delete();
        return redirect()->route('mapel.index')->with(['message'=>'Data berhasil dihapus']);

    }

    public function gurumapel()
    {
        $data = Mapel::with('sesi')->where('id_guru',auth()->user()->modelID)->get();
        return view('guru-mapel',compact('data'));
    }

    public function kehadiran(Request $request)
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

        return view('kehadiran',compact('mapel','cari','data'));
    }

    public function kehadiranAction(Request $request)
    {
        $check = Absensi::where('tanggal','like', date('Y-m-d').'%')->where('id_mapel',$request->id_mapel)->count();
        if($check > 0){
            Session::flash('message','Absensi sudah ditambahkan');
            return redirect()->back();
        }

        $mapel = Mapel::where('id_mapel',$request->id_mapel)->first();
        $tahun = TahunAkademik::where('status','aktif')->first();
        $id_siswa = $request->id_siswa;
        $kehadiran = $request->kehadiran;

        for ($i=0; $i < count($id_siswa); $i++)
        {
            Absensi::create([
                'id_mapel'=>$mapel->id_mapel,
                'id_siswa'=>$id_siswa[$i],
                'kelas'=>$mapel->nama_kelas,
                'presensi'=>$kehadiran[$i],
                'tanggal'=>date('Y-m-d H:i:s'),
                'tahun_akademik'=>$tahun->tahun_akademik,
                'semester'=>$tahun->semester
            ]);
        }

        return redirect()->route('kehadiran.list')->with(['message'=>'Data berhasil ditambahkan']);

    }

    public function listKehadiran(Request $request)
    {
        $mapel = [];

        if(auth()->user()->namespace == '\App\Models\Guru'){
            $mapel = Mapel::where('id_guru',auth()->user()->modelID)->get();
        }else if(auth()->user()->namespace == '\App\Models\Siswa'){
            $tahunAkademik = TahunAkademik::where('status','aktif')->first();
            $kelasSiswa = KelasSiswa::where('id_siswa',auth()->user()->modelID)->where('id_tahun',$tahunAkademik->id_tahun)->pluck('nama_kelas')->toArray();
            $mapel = Mapel::whereIn('nama_kelas',$kelasSiswa)->get();
        }




        $datas = collect([]);
        $dataMonth = [];
        if($request->filled('id_mapel')){
            $dateNow = $request->filled('end_date') ? $request->end_date :  date('Y-m-d');
            $dateStart = $request->filled('start_date') ? $request->start_date :  date('Y').'-'.date('m').'-01';
            $periode = CarbonPeriod::create($dateStart,$dateNow);
            $dataMonth = $periode;
            $findMapel = Mapel::where('id_mapel',$request->id_mapel)->first();
            $kelasSiswa = KelasSiswa::where('nama_kelas',$findMapel->nama_kelas)->pluck('id_siswa')->toArray();

            $getSiswa = Siswa::query();
            if(auth()->user()->namespace == "\App\Models\Siswa"){
                $getSiswa = $getSiswa->where('id_siswa',auth()->user()->modelID);
            }

            $getSiswa = $getSiswa->whereIn('id_siswa',$kelasSiswa);
            $getSiswa = $getSiswa->get();

            foreach ($getSiswa as $item){
                $months = collect([]);
                foreach ($periode as $month){
                    $absen = Absensi::where('tanggal','like',$month->format('Y-m-d').'%')->where('id_mapel',$request->id_mapel)->where('id_siswa',$item->id_siswa)->first();
                    $months->push([
                        'month'=>$month->format('d M y'),
                        'absen'=>$absen ? $absen->presensi : 'alpha'
                    ]);
                }
                $datas->push([
                    'siswa'=>$item->nisn.' '.$item->nama,
                    'detail'=>$months
                ]);
            }
        }
        return view('kehadiran.list',compact('datas','mapel','dataMonth'));
    }


}

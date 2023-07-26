<?php

namespace App\Helpers;


use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Models\WaliKelas;

class  Raport{
    public static function get($request)
    {
        $waliKelas = WaliKelas::where('id_wali', auth()->user()->modelID)->first();
        $tahunAjaran = TahunAkademik::where('status','aktif')->first();
        $kelasSiswa = KelasSiswa::where('nama_kelas',$waliKelas->nama_kelas)->where('id_tahun',$tahunAjaran->id_tahun)->pluck('id_siswa')->toArray();
        $mapel = Mapel::where('nama_kelas',$waliKelas->nama_kelas)->get();

        $allSiswa = Siswa::whereIn('id_siswa',$kelasSiswa)->get();

        $siswa = Siswa::query();
        $siswa = $siswa->whereIn('id_siswa',$kelasSiswa);
        if($request->filled('id_siswa')){
            $siswa = $siswa->where('id_siswa',$request->id_siswa);
        }
        $siswa = $siswa->get();

        $datas = collect([]);

        foreach ($siswa as $s){
            $nilai = collect([]);
            foreach ($mapel as $m){
                $cariNilai = Nilai::where('id_siswa',$s->id_siswa)->where('id_mapel',$m->id_mapel)->where('nama_kelas',$waliKelas->nama_kelas)->first();
                $uh1 = $cariNilai->uh1 ?? 0;
                $uh2 = $cariNilai->uh2 ?? 0;
                $uh3 = $cariNilai->uh3 ?? 0;
                $uts = $cariNilai->uts ?? 0;
                $uas = $cariNilai->uas ?? 0;
                $total = $uh1 + $uh2 + $uh3 + $uts + $uas;
                $nilai->push((object)[
                    'id_mapel'=>$m->id_mapel,
                    'mapel'=>$m->mapel,
                    'nilai'=>$total / 5
                ]);
            }

            $totalNilai = $nilai->sum('nilai');

            $totalMapel = $nilai->count();
            $datas->push((object)[
                'siswa'=>$s,
                'detail'=>$nilai,
                'totalNilai'=>$totalNilai,
                'totalMapel'=>$totalMapel,
                'rata_rata'=>number_format($totalNilai / $totalMapel,2)
            ]);
        }
        return (object)[
            'body'=>$datas,
            'header'=>(object)[
                'kelas'=>$waliKelas->nama_kelas,
                'tahunajaran'=>$tahunAjaran->tahun_akademik,
                'semester'=>$tahunAjaran->semester,
            ],
            'siswa'=>$allSiswa
        ];
    }
}

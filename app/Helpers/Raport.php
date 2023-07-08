<?php

namespace App\Helpers;


use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Models\WaliKelas;

class  Raport{
    public static function get()
    {
        $waliKelas = WaliKelas::where('id_wali', auth()->user()->modelID)->first();
        $tahunAjaran = TahunAkademik::where('status','aktif')->first();
        $kelasSiswa = KelasSiswa::where('nama_kelas',$waliKelas->nama_kelas)->where('id_tahun',$tahunAjaran->id_tahun)->pluck('id_siswa')->toArray();
        $mapel = Mapel::where('nama_kelas',$waliKelas->nama_kelas)->get();
        $siswa = Siswa::whereIn('id_siswa',$kelasSiswa)->get();

        $datas = collect([]);

        foreach ($siswa as $s){
            $nilai = collect([]);
            foreach ($mapel as $m){
                $cariNilai = Nilai::where('id_siswa',$s->id_siswa)->where('id_mapel',$m->id_mapel)->where('nama_kelas',$waliKelas->nama_kelas)->first();
                $nilai->push((object)[
                    'id_mapel'=>$m->id_mapel,
                    'mapel'=>$m->mapel,
                    'nilai'=>$cariNilai
                ]);
            }

            $totalNilai = $nilai->map(function($item){
               $uh1 = $item->nilai->uh1 ?? 0;
               $uh2 = $item->nilai->uh2 ?? 0;
               $uh3 = $item->nilai->uh3 ?? 0;
               $uts = $item->nilai->uts ?? 0;
               $uas = $item->nilai->uas ?? 0;

               return $uh1 + $uh2 + $uh3 + $uts + $uas;
            });

            $totalNilai = $totalNilai->sum();

            $totalMapel = $nilai->count();
            $datas->push((object)[
                'siswa'=>$s,
                'detail'=>$nilai,
                'totalNilai'=>$totalNilai,
                'totalMapel'=>$totalMapel,
                'rata_rata'=>$totalNilai / ($totalMapel * 5)
            ]);
        }
        return (object)[
            'body'=>$datas,
            'header'=>(object)[
                'kelas'=>$waliKelas->nama_kelas,
                'tahunajaran'=>$tahunAjaran->tahun_akademik,
                'semester'=>$tahunAjaran->semester,
            ]
        ];
    }
}

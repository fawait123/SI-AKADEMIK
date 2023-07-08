<?php

namespace App\Helpers;


use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Models\WaliKelas;

class Legger{
    public static function getLegger()
    {
        $waliKelas = WaliKelas::where('id_wali', auth()->user()->modelID)->first();
        $tahunAjaran = TahunAkademik::where('status','aktif')->first();
        $kelasSiswa = KelasSiswa::where('nama_kelas',$waliKelas->nama_kelas)->where('id_tahun',$tahunAjaran->id_tahun)->pluck('id_siswa')->toArray();
        $mapel = Mapel::where('nama_kelas',$waliKelas->nama_kelas)->get();
        $siswa = Siswa::whereIn('id_siswa',$kelasSiswa)->get();

        $datas = collect([]);

        foreach ($mapel as $m){
            $siswas = collect([]);
            foreach ($siswa as $s){
                $cariNilai = Nilai::where('id_siswa',$s->id_siswa)->where('id_mapel',$m->id_mapel)->where('nama_kelas',$waliKelas->nama_kelas)->first();
                $siswas->push((object)[
                    'id_siswa'=>$s->id_siswa,
                    'nama'=>$s->nama,
                    'nilai'=>$cariNilai
                ]);
            }

            $datas->push((object)[
                'id_mapel'=>$m->id_mapel,
                'mapel'=>$m->mapel,
                'detail'=>$siswas,
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

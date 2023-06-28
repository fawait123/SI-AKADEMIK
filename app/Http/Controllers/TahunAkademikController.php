<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = TahunAkademik::get();
        return view('akademik.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('akademik.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'tahun_akademik'=>'required',
            'semester'=>'required',
            'status'=>'required'
        ]);

        if($request->status == 'aktif'){
            DB::table('tahun_akademik')->update([
                'status'=>'tidak aktif'
            ]);
        }


        TahunAkademik::create($request->all());

        return redirect()->route('tahun-akademik.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAkademik $tahunAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAkademik $tahunAkademik)
    {
        //
        $tahun = $tahunAkademik;
        $id = $tahunAkademik->id_tahun;
        return view('akademik.form',compact('id','tahun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAkademik $tahunAkademik)
    {
        //
        $request->validate([
            'tahun_akademik'=>'required',
            'semester'=>'required',
            'status'=>'required'
        ]);

        if($request->status == 'aktif'){
            DB::table('tahun_akademik')->update([
                'status'=>'tidak aktif'
            ]);
        }


        $tahunAkademik->update($request->all());

        return redirect()->route('tahun-akademik.index')->with(['message'=>'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAkademik $tahunAkademik)
    {
        $tahunAkademik->delete();

        return redirect()->route('tahun-akademik.index')->with(['message'=>'Data berhasil dihapus']);
    }
}

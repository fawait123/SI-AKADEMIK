<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

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
//        dd($data);
        return view('guru-mapel',compact('data'));
    }

}

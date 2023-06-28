<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Sesi::with('mapel')->latest()->get();
        return view('sesi.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $mapel = Mapel::get();
        return view('sesi.form',compact('mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'id_mapel'=>'required',
            'hari'=>'required',
            'jam_mulai'=>'required',
            'jam_selesai'=>'required'
        ]);

        Sesi::create($request->all());

        return redirect()->route('sesi.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sesi $sesi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sesi $sesi)
    {
        //
        $id = $sesi->id_sesi;
        $mapel = Mapel::get();
        return view('sesi.form',compact('mapel','id','sesi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sesi $sesi)
    {
        //
        $request->validate([
            'id_mapel'=>'required',
            'hari'=>'required',
            'jam_mulai'=>'required',
            'jam_selesai'=>'required'
        ]);

        $sesi->update($request->all());

        return redirect()->route('sesi.index')->with(['message'=>'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sesi $sesi)
    {
        //
        $sesi->delete();
        return redirect()->route('sesi.index')->with(['message'=>'Data berhasil dihapus']);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = WaliKelas::with('guru')->latest()->get();
        return view('wali-kelas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $guru = Guru::get();
        return view('wali-kelas.form',compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
           'nama_kelas'=>'required',
            'id_guru'=>'required'
        ]);

        WaliKelas::create($request->all());

        return redirect()->route('wali-kelas.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(WaliKelas $waliKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaliKelas $waliKelas)
    {
        //
        $id = $waliKelas->id_wali;
        $wali = $waliKelas;
        $guru = Guru::get();
        return view('wali-kelas.form',compact('id','wali','guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaliKelas $waliKelas)
    {
        //
        $request->validate([
            'nama_kelas'=>'required',
            'id_guru'=>'required'
        ]);

        $waliKelas->update($request->all());

        return redirect()->route('wali-kelas.index')->with(['message'=>'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaliKelas $waliKelas)
    {
        //
        $waliKelas->delete();
        return redirect()->route('wali-kelas.index')->with(['message'=>'Data berhasil dihapus']);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class KelasSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = KelasSiswa::with(['siswa','tahun'])->latest()->get();
        return view('kelas-siswa.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $siswa = Siswa::get();
        $tahun = TahunAkademik::get();
        return view('kelas-siswa.form',compact('siswa','tahun'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_siswa'=>'required',
            'id_tahun'=>'required',
            'nama_kelas'=>'required'
        ]);

        KelasSiswa::create($request->all());

        return redirect()->route('kelas-siswa.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(KelasSiswa $kelasSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelasSiswa $kelasSiswa)
    {
        //
        $siswa = Siswa::get();
        $tahun = TahunAkademik::get();
        $id = $kelasSiswa->id_kelas;
        $kelas = $kelasSiswa;
        return view('kelas-siswa.form',compact('siswa','tahun','kelas','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelasSiswa $kelasSiswa)
    {
        //
        $request->validate([
            'id_siswa'=>'required',
            'id_tahun'=>'required',
            'nama_kelas'=>'required'
        ]);

        $kelasSiswa->update($request->all());

        return redirect()->route('kelas-siswa.index')->with(['message'=>'Data berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelasSiswa $kelasSiswa)
    {
        //

        $kelasSiswa->delete();

        return redirect()->route('kelas-siswa.index')->with(['message'=>'Data berhasil dihapus']);
    }
}

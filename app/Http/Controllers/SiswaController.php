<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Siswa::latest()->get();
        return view('siswa.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('siswa.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'agama'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
            'nisn'=>'required|unique:siswa,nisn',
            'nis'=>'required|unique:siswa,nis',
            'nama_ayah'=>'required',
            'pekerjaan_ayah'=>'required',
            'nama_ibu'=>'required',
            'pekerjaan_ibu'=>'required',
        ]);

        $siswa = Siswa::create($request->all());

        User::create([
            'username'=>strtolower(join("",explode(' ',$request->nama))),
            'email'=>strtolower(join("_",explode(' ',$request->nama)).'@gmail.com'),
            'password'=>Hash::make('password'),
            'name'=>$request->nama,
            'namespace'=>'\App\Models\Siswa',
            'modelID'=>$siswa->id_siswa
        ]);

        return redirect()->route('siswa.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
        $id = $siswa->id_siswa;
        return view('siswa.form',compact('id','siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
        $request->validate([
            'nama'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'agama'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
            'nisn'=>'required|unique:siswa,nisn,'.$siswa->id_siswa.',id_siswa',
            'nis'=>'required|unique:siswa,nis,'.$siswa->id_siswa.',id_siswa',
            'nama_ayah'=>'required',
            'pekerjaan_ayah'=>'required',
            'nama_ibu'=>'required',
            'pekerjaan_ibu'=>'required',
        ]);

        $siswa->update($request->all());
        return redirect()->route('siswa.index')->with(['message'=>'Data berhasil diubah']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        //

        $siswa->delete();

        return redirect()->route('siswa.index')->with(['message'=>'Data berhasil dihapus']);
    }
}

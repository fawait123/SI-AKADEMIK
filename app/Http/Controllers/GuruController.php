<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\TextUI\XmlConfiguration\PHPUnit;
use Webpatser\Uuid\Uuid;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Guru::get();
        return view('guru.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('guru.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required|unique:guru,nama',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'status_kepegawaian'=>'required',
            'agama'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
        ]);

        $guru = Guru::create($request->all());

        User::create([
            'username'=>strtolower(join("",explode(' ',$request->nama))),
            'email'=>strtolower(join("_",explode(' ',$request->nama)).'@gmail.com'),
            'password'=>Hash::make('password'),
            'name'=>$request->nama,
            'namespace'=>'\App\Models\Guru',
            'modelID'=>$guru->id_guru
        ]);

        return redirect()->route('guru.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $guru = Guru::find($id);
        if(!$guru){
            abort(404);
        }

        return view('guru.form',compact('guru','id'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $request->validate([
            'nama'=>'required',
            'tempat_lahir'=>'required',
            'tanggal_lahir'=>'required',
            'jenis_kelamin'=>'required',
            'status_kepegawaian'=>'required',
            'agama'=>'required',
            'no_hp'=>'required',
            'alamat'=>'required',
        ]);

        $guru = Guru::find($id);

        $guru->update($request->all());

        return redirect()->route('guru.index')->with(['message'=>'Data berhasil diubah']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::find($id);

        $guru->delete();

        return redirect()->route('guru.index')->with(['message'=>'Data berhasil dihapus']);
    }
}

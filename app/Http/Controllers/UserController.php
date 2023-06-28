<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = User::get();
        return view('user.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $guru = Guru::get();
        $siswa = Siswa::get();
        return view('user.form',compact('guru','siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'username'=>'required|unique:users,username',
            'modelID'=>'required|unique:users,modelID',
            'password'=>'required|min:8',
        ]);

        $check = User::where('modelID',$request->modelID)->first();
        if(!$check){
            return back()->withInput()->withErrors(['name','Data sudah ditambahkan']);
        }

        User::create($request->all());

        return redirect()->route('user.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $guru = Guru::get();
        $siswa = Siswa::get();
        $id = $user->id;
        return view('user.form',compact('guru','siswa','id','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$user->id,
            'username'=>'required|unique:users,username,'.$user->id,
            'modelID'=>'required|unique:users,modelID,'.$user->id,
        ]);
        $data = $request->all();
        $data['password'] = $user->password;
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with(['message'=>'Data berhasil ditambahkan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

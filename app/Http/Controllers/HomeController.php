<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //  function index
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalMapel = Mapel::pluck('mapel')->unique()->toArray();
        $totalMapel = count($totalMapel);
        return view('home',compact('totalSiswa','totalGuru','totalMapel'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Helpers\Raport;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    //
    public function index()
    {
        $data = Raport::get();

        return view('raport.index',compact('data'));
    }

    public function download()
    {
        $data = Raport::get();
        return view('raport.download',compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Raport;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = Raport::get($request);

        return view('raport.index',compact('data'));
    }

    public function download(Request $request)
    {
        $data = Raport::get($request);
        return view('raport.download',compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Legger;
use Illuminate\Http\Request;

class LeggerController extends Controller
{
    //
    public function index()
    {
        $data = Legger::getLegger();

        return view('legger.index',compact('data'));
    }

    public function download()
    {
        $data = Legger::getLegger();
        return view('legger.download',compact('data'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //  login function
    public function login(Request $request)
    {
        $request->validate([
           'username'=>'required',
           'password'=>'required'
        ]);

        $user = User::where('username',$request->username)->orWhere('email',$request->username)->first();

        if(!$user){
            return redirect()->back()->withErrors(['username'=>'These credentials dosnt match to our record']);
        }

        if(!Hash::check($request->password, $user->password)){
            return redirect()->back()->withErrors(['username'=>'These credentials dosnt match to our record']);
        }

        Auth::login($user,true);

        return redirect()->route('home');
    }

}

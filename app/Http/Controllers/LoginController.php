<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function save(Request $req)
    {
        $validate = $req->validate([
            'email'=> "required|string|email",
            'password'=> "required"
        ]);

        if(Auth::attempt($validate, $req->input('remember'))){

            $row = Auth::authenticate();
            $req->session()->put("USERS",$row);

            return redirect()->intended('/');

            // dd($req->session()->all());
        }
        return back()->withErrors(['email'=>'Wrong login details']);
    }
}

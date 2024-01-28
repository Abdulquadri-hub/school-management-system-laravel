<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    //
    public function index()
    {
        return view('auth.forgotpassword');
    }


    public function email(Request $req)
    {
        if(($req->method() == "POST")){
            
            $req->validate([
                'email' => "required|string|email",
            ]);

            if(user::where('email', '=', $req->input('email'))){
                dd("email sure exists");
            }
        }
        return view('auth.forgotpassword');
    }


    public function code(Request $req)
    {
        return view('auth.forgotpassword-code');
    }

    public function password(Request $req)
    {
        return view('auth.forgotpassword-password');
    }
}

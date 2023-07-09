<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    //
    public function index(Request $req)
    {
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

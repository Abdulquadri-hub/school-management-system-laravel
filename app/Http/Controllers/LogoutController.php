<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller{
    //
    public function logout(Request $req)
    {
        Auth::logout();

        $req->session()->invalidate();
    
        $req->session()->regenerateToken();

        return redirect('/login');
    }
}

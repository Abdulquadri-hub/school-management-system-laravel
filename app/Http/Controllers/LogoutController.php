<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function index(Request $req, )
    {
        if(session()->exists('USERS')){
            $flush = session()->flush();
            if($flush){
                return redirect('/login');
            }
        }
    }
}

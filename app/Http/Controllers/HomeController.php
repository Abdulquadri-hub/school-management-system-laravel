<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        
        return view('/home',[
            'rank' => new Rank(),
        ]);
    }
}

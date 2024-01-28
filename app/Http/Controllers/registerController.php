<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str; 
use App\Models\User;

class registerController extends Controller
{
    //

    public function index(Request $req)
    {
        $mode = isset($_GET['mode']) ? $_GET['mode'] : "";

        return view('auth.register',[
            'mode'=>$mode
        ]);
    }

    public function save(Request $req){

        $mode = isset($_GET['mode']) ? $_GET['mode'] : "";

        $req->validate([
            'firstname' => "required|string",
            'lastname' => "required|string",
            'email' => "required|string|email|unique:users",
            'gender' => "required|string",
            'rank' => "required|string",
            'password' => "required|max:8",
        ]);

        $user = new User();

        $user_id = $req->input('firstname') . "." . $req->input('lastname');
        $save = $user->insert([
            'firstname' => $req->input('firstname'),
            'lastname' => $req->input('lastname'),
            'email' => $req->input('email'),
            'gender' => $req->input('gender'),
            'rank' => $req->input('rank'),
            'password' => Hash::make($req->input('password')),
            'user_id' => strtolower($user_id) . "." . Str::random(4),
            'school_id' => session()->exists("USERS_ROW") ? session('USERS_ROW')->school_id : "",
            'created_at'=> date("Y-m-d H:i:s"),
            'updated_at'=> date("Y-m-d H:i:s")
        ]);

        if($save){
            if($mode == "students"){

                return redirect("/students");
            }elseif($mode == "staffs"){
                
                return redirect("/staffs");
            }else{
                return redirect("/login");
            }

        }
    }

}

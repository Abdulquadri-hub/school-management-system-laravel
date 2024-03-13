<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 

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
        // $password = "";
        // if($mode == "students"){
                
        //     $password  =  Str::random(8);
            
        // }elseif($mode == "staffs"){

        //     $password  =  Str::random(8);

        // }else{

        //     $password  =  $req->input('password');
        // }
       
        $save = User::insert([
            'firstname' => $req->input('firstname'),
            'lastname' => $req->input('lastname'),
            'email' => $req->input('email'),
            'gender' => $req->input('gender'),
            'rank' => $req->input('rank'),
            'password' => Hash::make($req->input('password')),
            'user_id' => strtolower($user_id) . "." . Str::random(4),
            'school_id' => session()->exists("USERS_ROW") ? session('USERS_ROW')->school_id : null,
            'created_at'=> date("Y-m-d H:i:s"),
            'updated_at'=> date("Y-m-d H:i:s")
        ]);

        
        if($save){

            $row = $user->where('email', $req->input('email'))->first();
            if(!empty($row))
            {
                $row->email_verify_token =  Str::random(40);
                $row->save();
                      
                try {
                    
                    $row->user_password =  $req->input('password');
                    Mail::to($row->email)->send(new VerifyMail($row));

                    if($mode == "students"){
                
                        return redirect("/students")->with('status', "Registered! An email has been sent to this student for verification");
                        
                    }elseif($mode == "staffs"){

                        return redirect("/staffs")->with('status', "Registered! An email has been sent to this staff for verification");

                    }else{

                        return redirect("/login")->with('status', "Registered! An email has been sent to you");
                    }

                } catch (\Exception $e) {
                    dd($e);
                }
            }
        }else {
            return back()->with('error', "Something went wrong!");
        }
    }

}

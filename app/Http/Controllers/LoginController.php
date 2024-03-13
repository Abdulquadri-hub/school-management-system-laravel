<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;

class LoginController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }

    public function save(Request $req)
    {
        $user = new User();

        $validate = $req->validate([
            'email'=> "required|string|email",
            'password'=> "required"
        ]);

        if(Auth::attempt($validate, $req->input('remember'))){

            $row = Auth::authenticate();
        
            if($row->email_verified_at)
            {
                if($row->rank !== "super admin")
                {
                    $school = new School();
                    $school_row  = $school->where('school_id', $row->school_id)->first();
        
                    $row->school_name = $school_row->school;
                    
                    $req->session()->put("USERS_ROW",$row);
                
                    return redirect()->intended('/');
                }
                
                $school = new School();
                $school_row  = $school->where('school_id', $row->school_id)->first();
    
                $row->school_name = $school_row->school;
                
                $req->session()->put("USERS_ROW",$row);
                return redirect()->intended('/');
            }
            
            return back()->withErrors(['email'=>'Kindly verify your email']);
            
        }
        return back()->withErrors(['email'=>'Wrong login details']);
    }
}

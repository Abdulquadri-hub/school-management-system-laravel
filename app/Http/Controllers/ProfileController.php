<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(Request $req, $userid = ""){

        $page = "Profile";

        $user = new User();

        $tab = !empty($_GET['tab']) ? $_GET['tab'] : "";

        switch ($tab) {
            case 'edit':
                if($req->method() == 'POST'){
                    
                    $req->validate([
                        'firstname' => "required|string",
                        'lastname' => "required|string",
                        'email' => "required|string|email",
                        'gender' => "required|string",
                        'rank' => "required|string",
                    ]);

                    $VAR = [
                        'firstname' => $req->input('firstname'),
                        'lastname' => $req->input('lastname'),
                        'email' => $req->input('email'),
                        'gender' => $req->input('gender'),
                        'rank' => $req->input('rank'),
                        'updated_at'=> date("Y-m-d H:i:s")
                    ];

                    $save = $user->where('user_id', $userid)->update($VAR);

                    if($save){
                        return redirect("/profile/$userid")->with('status', 'Profile updated!');
                    }
        
                    return back()->withErrors('status', 'Something went wrong!');
                }
                break;
            
            default:
                # code...
                break;
        }

        $row = User::where('user_id', $userid)->first();

        return view('profile',[
            'page' => $page,
            'row' => $row,
            'tab' => $tab
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Rank;
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
                $row = User::where('user_id', $userid)->first();
                break;
        }

        $row = User::where('user_id', $userid)->first();
// dd($row);
        if(Rank::i_own_content($row) || Rank::hasRank('instructor'))
        {
            return view('profile',[
                'page' => $page,
                'rank' => new Rank(),
                'row' => $row,
                'tab' => $tab
            ]);  
        }else {
            return redirect('/access-denied');
        }
    }

}

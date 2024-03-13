<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    //

    public function index(Request $req, $token = "")
    {

        $error = "";
        $success = "";
        $page = "Verify Mail";


        if(!empty($token))
        {
            
            $row = User::where("email_verify_token", $token)->first();
            if(!empty($row))
            {
                
                $row->email_verified_at = date("Y-m-d H:i:s");
                $row->email_verify_token =  Str::random(40);
                $row->save();

                $success =  "You are verified! Kindly login with your email and password sent to you";

            }else {

                $error = "Invalid Token";
                
                if($req->method() == "POST")
                {
                    if(isset($_POST['generate-token']))
                    {
                        $uid = $_GET['uid'] ?? "";
                        if(!empty($uid))
                        {
                            $row = User::where('user_id', $uid)->first();
                            $row->email_verify_token =  Str::random(40);
                            $row->save();
                                  
                            try {
                                
                                Mail::to($row->email)->send(new VerifyMail($row));

                                $success = "A new token has been sent to your email & copy your password from the previous mail sent to you to login";
            
                            } catch (\Exception $e) {
                                dd($e);
                            }

                        }
                    }
                }

            }

        }else {
             $error = "Invalid Token";
        }


        return view('auth.verifyemail', [
            'error' => $error,
            'success' => $success,
            'page' => $page,
            'row' => $row
        ]);
    }

    // public function generateToken(Request $req, $uid = "")
    // {
    //     //
    // }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ForgotPassword extends Model
{
    use HasFactory;

    public static function validEmail($email)
    {
        if(!empty($email)){
            $user = new User();
            if($user->where("email", '=', $email)){
                return true;
            }
            return false;
        }
    }

    public static function validcode($code, $email)
    {
        if(!empty($email) && !empty($code)){
            $VARS = [
                'code' => $code,
                'email' => $email
            ];
            if((self::all()->where($VARS))){
                return true;
            }
            return false;
        }
    }

    public static function newPassword($password){}
}

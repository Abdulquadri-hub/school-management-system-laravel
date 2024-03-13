<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rank extends Model
{
    use HasFactory;

    public static function hasRank($rank = 'student')
    {
        if(!Auth::check())
        {
            return false;
        }

        
        $logged_in_rank = session('USERS_ROW')->rank;

        
        $RANK['super admin'] = ['super admin', 'admin', 'instructor', 'students'];
        $RANK['admin']       = ['admin', 'instructor','students'];
        $RANK['instructor']  = ['instructor', 'students'];
        $RANK['student']     = ['student'];

        
        if (!isset($RANK[$logged_in_rank])) 
        {
            return false;
        }

        if (in_array($rank, $RANK[$logged_in_rank])) 
        {
            return true;
        }

        return false;
    }


    public static function i_own_content($row)
    {

        if(!Auth::check())
        {
            return false;
        }


        if (isset($row->user_id)) 
        {
            if (session('USERS_ROW')->user_id == $row->user_id)
            {
                return true;
            }
        }

        return false;
    }
}

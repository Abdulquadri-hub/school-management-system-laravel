<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    public  function switch_school($id){

        if (session()->exists('USERS_ROW') && session('USERS_ROW')->rank == 'super admin') 
        {
            $user = new User();
            $school = new School();
            if($row = $school->where('id',$id)->first()){

                $VAR = ['school_id' => $row->school_id];

                $user->where('id', session('USERS_ROW')->id)->update($VAR);
                
                // put the new school name and id into the users session
                session('USERS_ROW')->school_id = $row->school_id;
                session('USERS_ROW')->school_name = $row->school;
                
            }
            return true;
        }
        return false;
    }

}

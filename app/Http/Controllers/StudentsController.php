<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

class StudentsController extends Controller
{
    //
    public function index(Request $req){

        $page = "Students";

        $user = new User();
        $school_id = session()->get('USERS_ROW')->school_id;
        $rows = $user->all()->where("rank", 'student')
                    ->where("school_id", $school_id);
        
        return view('/students.student',[
            'page' =>$page,
            'rank' => new Rank(),
            'rows' => $rows
        ]);
    }
}

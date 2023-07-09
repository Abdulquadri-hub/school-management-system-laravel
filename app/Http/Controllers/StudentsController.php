<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str; 
use App\Models\User;

class StudentsController extends Controller
{
    //
    public function index(Request $req)
    {
        $page = "Students";
        
        return view('/students.student',[
            'page' =>$page
        ]);
    }
}

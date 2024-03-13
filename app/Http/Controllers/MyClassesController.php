<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\User;
use App\Models\Classes;
use App\Models\class_enroll_students;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;

class MyClassesController extends Controller
{
    //
    public function index(Request $request)
    {
        $page = "My Classes";
        $user = new User();
   
        $class = new Classes();
        $class_enroll_student = new Class_enroll_students();

        $user_id = session()->get('USERS_ROW')->user_id;

        $myclass = $class_enroll_student->where('class_enroll_students.user_id', $user_id)
                ->where('class_enroll_students.enrolled', 1)
                ->join('users', 'class_enroll_students.user_id', '=', 'users.user_id')
                ->join('classes', 'class_enroll_students.class_id', '=', 'classes.class_id')
                ->select('users.firstname', 'users.lastname', 'classes.*')
                ->get();

        return view("myclasses.myclass",[
            'page'=>$page,
            'rows' =>$myclass,
            'rank' => new Rank(),
        ]);
    }
}

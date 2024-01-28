<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use App\Models\Lesson;
use App\Models\Classes;
use App\Models\User;

class LessonsController extends Controller
{
    public function index()
    {
        //
        $page = "Lessons";
        $user = new User();
        $lesson = new Lesson();

        $data = $lesson->all();

        foreach ($data as $key => $value) {
            $data[$key]->user = DB::table('users')->where("user_id", $data[$key]->user_id)->first();
        }

        //dd($data);
        return view('lessons.lesson',[
            'page'=>$page,
            'rows' =>$data
        ]);
    }

    public function single(Request $req, $id)
    {
        
        $class = new Classes();
        $lesson = new Lesson();
        $tab = $_GET['tab'] ??  "";

        $row = $lesson->find($id);

        foreach ($row as $key => $value) {
            $row->user = DB::table('users')->where("user_id", $row->user_id)->first();
            $row->class = DB::table('classes')->where("class_id", $row->class_id)->first();
        }


        return view('lessons.single', [
            'page' => $row->title,
            'row' => $row,
            'tab' => $tab,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use App\Models\Classes;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Material;

class ClassesController extends Controller
{
    //

    public function index()
    {
        //
        $page = "Classes";
        $user = new User();
        $class = new Classes();

        $data = $class->all();

        foreach ($data as $key => $value) {
            $data[$key]->user = DB::table('users')->where("user_id", $data[$key]->user_id)->first();
        }

        //dd($data);
        return view('classes.class',[
            'page'=>$page,
            'rows' =>$data
        ]);
    }

    public function add(Request $req)
    {
        //
        $page = "Add Class";

        if(count($req->all()) > 0){
            $req->validate([
                'class' => "required|string"
            ]);

            $school = new Classes();
            $save = $school->insert([
                'class' => $req->input('class'),
                'class_id' => Str::random(),
                'user_id' => $req->session()->get('USERS_ROW')->user_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            if($save){
                return redirect('/classes')->with('status', 'New class added!');
            }

            return back()->withErrors('classes', 'Something went wrong!');
        }
        return view('classes.add',[
            'page' => $page
        ]);
    }

    public function edit(Request $req, $id = '')
    {
        //
        $page = "Edit class";
        $class = new Classes();

        if(count($req->all()) > 0){
            $req->validate([
                'class' => "required|string"
            ]);

            $VAR = ['class' => $req->input('class')];

            $save = $class->where('id', $id)->update($VAR);

            if($save){
                return redirect('/classes')->with('status', 'Class updated!');
            }

            return back()->withErrors('class', 'Something went wrong!');
        }

        $row = $class->find($id);
        
        return view('classes.edit',[
            'page' => $page,
            'row' => $row
        ]);
    }

    public function delete(Request $req, $id = '')
    {
        //
        $page = "Delete Class";
        $class = new Classes();

        $row = $class->find($id);

        if(count($req->all()) > 0){

            $trash = $row->delete();
            if($trash){
                return redirect('/classes')->with('status', 'class trashed!');
            }

            return back()->withErrors('class', 'Something went wrong!');
        }
        return view('classes.delete',[
            'page' => $page,
            'row' => $row
        ]);
    }

    public function single(Request $req, $id = '')
    {
        
        $class = new Classes();
        $lesson = new Lesson();
        $material = new Material();

        $tab = $_GET['tab'] ??  "";
        $lesson_id = $_GET['lesson_id'] ?? "";

        $lesson_rows = [];
        $lesson_row = [];
        $material_rows = [];

        $row = $class->find($id);

        if($tab == "lessons")
        {
            $lesson_rows = $lesson->where("class_id", $row->class_id)->orderBy("id","asc")->get();
            foreach ($lesson_rows as $key => $value) {
                $lesson_rows[$key]->user = DB::table('users')->where("user_id",  $lesson_rows[$key]->user_id)->first();
                $lesson_rows[$key]->class = DB::table('classes')->where("class_id",  $lesson_rows[$key]->class_id)->first();
            }

        }else 
        if($tab == "add-lesson")
        {
            $page = "Add Lesson";
            
            if($req->method() == "POST"){
                
                $req->validate([
                'title' => "required|string",
                'content' => "required|string"
                ]);

                $content = Str::of($req->input('content'))->stripTags();
                
                $save = $lesson->insert([
                    'title' => $req->input('title'),
                    'content' => $content,
                    'lesson_id' => Str::random(),
                    'class_id' => $row->class_id,
                    'user_id' => $req->session()->get('USERS_ROW')->user_id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

                if($save){
                    return redirect("/classes/single/$id?tab=lessons")->with('status', 'New lesson added!');
                }

                return back()->withErrors('lessons', 'Something went wrong!');
            }
        
        }else 
        if($tab == "edit-lesson" && $lesson_id)
        {
            $lesson_row = $lesson->find($lesson_id);
            
            if($req->method() == "POST"){
                
                $req->validate([
                'title' => "required|string",
                'content' => "required|string"
                ]);

                $content = Str::of($req->input('content'))->stripTags();
                $VAR = [
                    'title' => $req->input('title'),
                    'content' => $content,
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $save = $lesson->where('id', $lesson_id)->update($VAR);

                if($save){
                    return back()->with('status', 'Class Lesson updated!');
                }
    
                return back()->withErrors('lesson', 'Something went wrong!');
            }
        }else 
        if($tab == "delete-lesson" && $lesson_id)
        {
            $lesson_row = $lesson->find($lesson_id);
            
            if($req->method() == "POST"){

  
                $trash = $lesson->where('id', $lesson_id)->delete();
                if($trash){
                    return redirect("/classes/single/$id?tab=lessons")->with('status', 'class lesson trashed!');
                }
    
                return back()->withErrors('class', 'Something went wrong!');
            }
        }else 
        if($tab == "materials")
        {
            $material_rows = $material->where("class_id", $row->class_id)->orderBy("id","asc")->get();
            foreach ($material_rows as $key => $value) {
                $material_rows[$key]->user = DB::table('users')->where("user_id",  $material_rows[$key]->user_id)->first();
                $material_rows[$key]->class = DB::table('classes')->where("class_id",  $material_rows[$key]->class_id)->first();
            }
        }else 
        if($tab == "add-materials")
        {
            //
            if($req->method() == "POST"){
                
                $material = new Material();

                $req->validate([
                'name' => "required|string",
                'file' => "required|mimes:pdf,doc,docx,ppt,pptx,mp4|max:20480"
                ]);
                
                $file = $req->file('file');
                $fileName = Str::random() . "_" . $file->getClientOriginalName();
                $filePath = $file->storeAs('class_materials', $fileName, 'public');

                if($filePath)
                {
                    $save = $material->insert([
                        'name' => $req->input('name'),
                        'file' => $filePath,
                        'material_id' => Str::random(),
                        'class_id' => $row->class_id,
                        'user_id' => $req->session()->get('USERS_ROW')->user_id,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
    
                    if($save){
                        return redirect("/classes/single/$id?tab=materials")->with('status', 'New material uploaded!');
                    }
                }
                
                return back()->withErrors('materials', 'Something went wrong!');

            }
        }
    

        foreach ($row as $key => $value) {
            $row->user = DB::table('users')->where("user_id", $row->user_id)->first();
        }


        return view('classes.single', [
            'page' => $row->class,
            'row' => $row,
            'tab' => $tab,
            'lesson_rows' => $lesson_rows,
            'lesson_row' => $lesson_row,
            'material_rows' => $material_rows
        ]);
    }
}

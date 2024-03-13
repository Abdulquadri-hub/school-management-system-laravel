<?php

namespace App\Http\Controllers;

use App\Models\assignment;
use App\Models\Rank;
use App\Models\User;
use App\Models\Classes;
use App\Models\class_lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use App\Models\class_instructor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\class_enroll_students;
use App\Notifications\NewLessonNotification;
use Illuminate\Notifications\DatabaseNotification;

class ClassesController extends Controller
{
    //

    public function index()
    {
        //
        $page = "Classes";

        $user = new User();
        $class = new Classes();

        $user_id = session()->get('USERS_ROW')->user_id;

        if(Rank::hasRank('instructor'))
        {
            
            $school_id = session()->get('USERS_ROW')->school_id;
            $data  =  $class->join('users', 'classes.user_id', '=', 'users.user_id')
            ->where("classes.school_id", $school_id)
            ->select('users.firstname', 'users.lastname', 'classes.*')
            ->get();

        } else {

            if(Rank::hasRank())
            {
                $data  =  $class->join('users', 'classes.user_id', '=', 'users.user_id')
                ->select('users.firstname', 'users.lastname', 'classes.*')
                ->get();

                // dd($data);
            }
        }

        return view('classes.class',[
            'page'=>$page,
            'rows' =>$data,
            'rank' => new Rank(),
            // 'enrolled' => $enrolled,
            // 'enroll_user_id' => $enroll_user_id,
            'user_id' => $user_id,
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
                'school_id' => $req->session()->get('USERS_ROW')->school_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            if($save){
                return redirect('/classes')->with('status', 'New class added!');
            }

            return back()->withErrors('classes', 'Something went wrong!');
        }

        if(Rank::hasRank('instructor'))
            return view('classes.add',[
                'page' => $page,
                'rank' => new Rank(),
            ]);
        else 
            return redirect('/access-denied');
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

        if(Rank::hasRank('instructor'))    
            return view('classes.edit',[
                'page' => $page,
                'row' => $row,
                'rank' => new Rank(),
            ]);
        else 
            return redirect('/access-denied');
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
        
        if(Rank::hasRole('instructor')) 
            return view('classes.delete',[
                'page' => $page,
                'row' => $row,
                'rank' => new Rank(),
            ]);
        else 
            return redirect('/access-denied');
    }

    public function single(Request $req, $id = '')
    {
        
        $class = new Classes();
        $class_lesson = new Class_lesson();
        $class_instructor = new class_instructor();
        $class_enroll_student = new class_enroll_students();
        $lesson_assignment = new Assignment();
        $user = new User();

        $tab = $_GET['tab'] ??  "";
        $tab1 = $_GET['tab1'] ?? ""; 
        $lesson_id = $_GET['lesson_id'] ?? "";
        $single_lesson_id = $_GET['single_lesson_id'] ?? "";

        $lessons = [];
        $lesson_row = [];
        $single_lesson_row = [];
        $instructors = [];
        $enrolled_students = [];

        if(Rank::hasRank("student"))
        {
            $row = $class->where('classes.id',$id)
            ->where('class_enroll_students.enrolled', 1)
            ->join('class_enroll_students', 'class_enroll_students.class_id', '=', 'classes.class_id')
            ->join('users', 'users.user_id', "=", 'classes.user_id')
            ->select('users.firstname', 'users.lastname', 'classes.*')->first();

        }else
        if(Rank::hasRank("instructor")){

            $row = $class->where('classes.id',$id)
            ->join('users', 'users.user_id', "=", 'classes.user_id')
            ->select('users.firstname', 'users.lastname', 'classes.*')->first();

            $lrow = $class_lesson->find($single_lesson_id);
        }

        switch ($tab || $tab1) {

            case 'instructors':
                
                $instructors = $class_instructor->where('class_instructors.class_id', $row->class_id)
                ->where('class_instructors.disabled', 0)
                ->join('classes', 'class_instructors.class_id', '=', 'classes.class_id')
                ->join('users', 'class_instructors.user_id', '=', 'users.user_id')
                ->select('users.*', 'classes.class')
                ->get();

                break;

            case 'add-instructor':

                //
                if(isset($_POST['search']))
                {
                    
                    $req->validate([
                        'instructor' => "required|string",
                    ]);
    
                    $find = "%" . trim($req->input('instructor')) . "%";
                    if(!empty($find))
                    {
                        $instructors  = $user->where('firstname', 'like', $find)->orWhere('lastname', 'like', $find)->where('rank', '=', 'instructor')->get();
                        // dd($instructors);
                    }
    
                }else 
                if(isset($_POST['selected']))
                {
                    $check = $class_instructor->select('disabled', 'id')->where('user_id', $_POST['selected'])->where('class_id', $row->class_id)->first();
                    
                    if(!$check)
                    {
                        $selected =  $_POST['selected'];

                        $save = $class_instructor->insert([
                            'user_id' => $selected,
                            'class_id' => $row->class_id,
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
        
                        if($save){
                            return redirect("/classes/single/$id?tab=instructors")->with('status', 'Class Instuctor added!');
                        }
        
                        return back()->withErrors('class_instructor', 'Something went wrong!');

                    } else {
                        if(isset($check->disabled))
                        {
                            
                            $VAR = [
                                'disabled' => 0,
                                'updated_at' => date("Y-m-d H:i:s")
                            ];
            
                            $save = $class_instructor->where('id', $check->id)->update($VAR);
            
                            if($save){
                                return redirect("/classes/single/$id?tab=instructors")->with('status', 'Class Instuctor already Exists & updated!');
                            }
                
                            return back()->withErrors('class_instrctor', 'Something went wrong!');
                        }
                    }
                }

                break;

            case 'remove-instructor':
                
                if(isset($_POST['search']))
                {
                    
                    $req->validate([
                        'instructor' => "required|string",
                    ]);
    
                    $find = "%" . trim($req->input('instructor')) . "%";
                    if(!empty($find))
                    {
                        $instructors  = $user->where('firstname', 'like', $find)->orWhere('lastname', 'like', $find)->where('rank', '=', 'instructor')->get();
                    }
    
                }else 
                if(isset($_POST['selected']))
                {
                    $check = $class_instructor->select('disabled', 'id')->where('user_id', $_POST['selected'])->where('class_id', $row->class_id)->first();
                    if($check)
                    {
                        $save = $class_instructor->where('id', $check->id)->update([
                            'disabled' => 1,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
        
                        if($save){
                            return redirect("/classes/single/$id?tab=instructors")->with('status', 'Class Instuctor removed!');
                        }
        
                        return back()->withErrors('class_instructor', 'Something went wrong!');

                    } 
                }

                break;
            case 'lessons':

                $lessons = $class_lesson->where("class_lessons.class_id", $row->class_id)
                ->join('classes', 'class_lessons.class_id', '=', 'classes.class_id')
                ->join('users', 'class_lessons.user_id', '=', 'users.user_id')
                ->select('users.firstname', 'users.lastname', 'users.rank', 'classes.id as classid', 'class_lessons.*')
                ->get();

                dd($lessons);
                
                break;

            case 'add-lesson':
                             
                if($req->method() == "POST"){
                
                $req->validate([
                'title' => "required|string",
                'content' => "required|string"
                ]);

                // $content = Str::of($req->input('content'))->stripTags();
                
                $save = $class_lesson->insert([
                    'title' => $req->input('title'),
                    'content' => $req->input('content'),
                    'lesson_id' => Str::random(),
                    'class_id' => $row->class_id,
                    'user_id' => $req->session()->get('USERS_ROW')->user_id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

                if($save){

                    //send notification
                    $enrolled_students = $class_enroll_student->where('class_enroll_students.class_id', $row->class_id)
                    ->where('class_enroll_students.enrolled', 1)
                    ->join('users',  'users.user_id' , '=', 'class_enroll_students.user_id')
                    ->join('classes',  'classes.class_id' , '=', 'class_enroll_students.class_id')
                    ->select('users.*', 'classes.id as classid')
                    ->get();
                   
                    $students = [];
                    foreach($enrolled_students as $enrolled_student)
                    {
                        try {
                            if (!is_null($enrolled_student->email)) {
                                $enrolled_student->notify(new NewLessonNotification($enrolled_student));
                            }
                        } catch (\Exception $e) {
                            Log::error("Error sending notification: " . $e->getMessage());
                        }
                    }


                    return redirect("/classes/single/$id?tab=lessons")->with('status', 'New lesson added!');

                }

                return back()->withErrors('lessons', 'Something went wrong!');

                }
        
                break;

            case 'edit-lesson':
                if($lesson_id) {
                    $lesson_row = $class_lesson->find($lesson_id);
                    
                    if($req->method() == "POST"){
                    
                       $req->validate([
                      'title' => "required|string",
                       'content' => "required|string"
                       ]);
    
                        // $content = Str::of($req->input('content'))    ->stripTags();
                        $VAR = [
                        'title' => $req->input('title'),
                        'content' => $req->input('content'),
                        'updated_at' => date("Y-m-d H:i:s")
                        ];
    
                        $save = $class_lesson->where('id', $lesson_id)->update($VAR);
        
                        if($save){
                        return redirect("/classes/single/$id?tab=lessons")->with('status', 'Class Lesson updated!');
                        }
            
                        return back()->withErrors('lesson', 'Something went wrong!');
                }
                
                }             
        
                break;
            case 'delete-lesson':
                              
                if($lesson_id) {
                    
                    if($req->method() == "GET"){
                    
                        $trash = $class_lesson->where('id', $lesson_id)->delete();
                        if($trash){
                            return redirect("/classes/single/$id?tab=lessons")->with('status', 'class lesson trashed!');
                        }
    
                        return back()->withErrors('class', 'Something went wrong!');
                    }
                }
                break;
            case 'single-lesson':

                
                $read = $_GET['read'] ?? "";  
                $user_id = session()->get('USERS_ROW')->user_id;     
                if($single_lesson_id) {
                    if($read !== "" && $read == "true")
                    {

                       $notify = DatabaseNotification::join('users', "notifications.notifiable_id", "=", "users.id")
                       ->where('users.user_id', $user_id)
                       ->select("users.*","notifications.*")
                       ->get();
                       if(!empty($notify))
                       {
                           $notify->markAsRead();
                       }
                    }

                    $single_lesson_row = $class_lesson->find($single_lesson_id);
                }
                break;
            case 'lesson-assignment':
                //
                break;

            case 'add-lesson-assignment':
                //
                                             
                if($req->method() == "POST"){
                
                    $req->validate([
                    'title' => "required|string",
                    'description' => "required|string",
                    'due_date' => "required"
                    ]);
                    
                    $save = $lesson_assignment->insert([
                        'title' => $req->input('title'),
                        'description' => $req->input('description'),
                        'assignment_id ' => Str::random(),
                        'lesson_id' => $lrow->lesson_id,
                        'class_id' => $row->class_id,
                        'user_id' => $req->session()->get('USERS_ROW')->user_id,
                        'due_date' => $req->input('due_date'),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
    
                    if($save){
    
                        //send notification
                        $enrolled_students = $class_enroll_student->where('class_enroll_students.class_id', $row->class_id)
                        ->where('class_enroll_students.enrolled', 1)
                        ->join('users',  'users.user_id' , '=', 'class_enroll_students.user_id')
                        ->join('classes',  'classes.class_id' , '=', 'class_enroll_students.class_id')
                        ->select('users.*', 'classes.id as classid')
                        ->get();
                       
                        $students = [];
                        foreach($enrolled_students as $enrolled_student)
                        {
                            try {
                                if (!is_null($enrolled_student->email)) {
                                    $enrolled_student->notify(new NewLessonNotification($enrolled_student));
                                }
                            } catch (\Exception $e) {
                                Log::error("Error sending notification: " . $e->getMessage());
                            }
                        }
    
                    return redirect("/classes/single/$id?tab=single-lesson&tab1=lesson-assignment&single_lesson_id=$lrow->id")->with('status', 'New lesson assignment added!');
    
                    }
    
                    return back()->withErrors('lessons', 'Something went wrong!');
                }
                break;
            
            case 'enrolled-students':

                $enrolled_students = $class_enroll_student->where('class_enroll_students.class_id', $row->class_id)
                ->where('class_enroll_students.enrolled', 1)
                ->join('users',  'users.user_id' , '=', 'class_enroll_students.user_id')
                ->select('users.*')
                ->get();
                dd($enrolled_students);
                break;
            
            case 'remove-enrolled-student':
                
                if(isset($_POST['search']))
                {
                    
                    $req->validate([
                        'student' => "required|string",
                    ]);
    
                    $find = "%" . trim($req->input('student')) . "%";
                    if(!empty($find))
                    {

                      $enrolled_students = $class_enroll_student
                        ->join('users', 'users.user_id', '=', 'class_enroll_students.user_id')
                        ->where('class_enroll_students.class_id', $row->class_id)
                        ->where('class_enroll_students.enrolled', 1)
                        ->where(function ($query) use ($find) {
                            $query->where('users.firstname', 'like', $find)
                                  ->orWhere('users.lastname', 'like', $find);
                        })
                        ->select('users.*')
                        ->distinct()
                        ->get();
                    }
    
                }else 
                if(isset($_POST['selected']))
                {
                    $check = $class_enroll_student->select('enrolled', 'id')
                    ->where('user_id', $_POST['selected'])
                    ->where('class_id', $row->class_id)->first();
                    
                    if($check)
                    {
                        $save = $class_enroll_student->where('id', $check->id)->update([
                            'enrolled' => 0,
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
        
                        if($save){
                            return redirect("/classes/single/$id?tab=enrolled-students")->with('status', 'Class Enrolled Students Removed!');
                        }
        
                        return back()->withErrors('error', 'Something went wrong!');

                    } 
                }

                break;
            
            default:
                return view('classes.single', [
                    'page' => $row->class,
                    'row' => $row,
                    'tab' => $tab,
                    'tab1' => $tab1,
                    'instructor_rows' => $instructors,
                    'lessons_rows' => $lessons,
                    'rank' => new Rank(),
                    'lesson_row' => $lesson_row,
                    'single_lesson_row' => $single_lesson_row,
                    'enrolled_student_rows' => $enrolled_students
                    
                ]);
                break;
        }

            return view('classes.single', [
                'page' => $row->class,
                'row' => $row,
                'tab' => $tab,
                'tab1' => $tab1,
                'instructor_rows' => $instructors,
                'lessons_rows' => $lessons,
                'rank' => new Rank(),
                'lesson_row' => $lesson_row,
                'single_lesson_row' => $single_lesson_row,
                'enrolled_student_rows' => $enrolled_students
            ]);

    }

    public function  enroll(request $req, $id = "")
    {
        $class = new Classes();
        $class_enroll_student = new class_enroll_students();

        $row  = $class->find($id);

        if($req->method() == "GET")
        { 
            
            if(!empty($id))
            {
                $user_id = session()->get('USERS_ROW')->user_id;
               
                $check =  $class_enroll_student->select('enrolled', 'id')
                ->where('user_id', $user_id)
                ->where('class_id', $row->class_id)->first();

                if(!$check)
                {
                    $save = $class_enroll_student->insert([
                        'user_id' => $user_id,
                        'class_id' => $row->class_id,
                        'enrolled' => 1,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);

                    if($save){
                        return redirect('/classes')->with('status', 'You are Enrolled for this class!');
                    }

                    return back()->withErrors('error', 'Something went wrong!');

                }else {

                    if(isset($check->enrolled))
                    {
                        $user_id = session()->get('USERS_ROW')->user_id;

                        $VAR = ['enrolled' => 1];
                        $save = $class_enroll_student->where('user_id', $user_id)
                                ->where('class_id', $row->class_id)
                                ->update($VAR);

                        if($save){
                            return redirect('/classes')->with('status', 'You Already Enrolled for this class!');
                        }
            
                        return back()->withErrors('status', 'Something went wrong!');
                    }
                }
            }
        }
    }


}

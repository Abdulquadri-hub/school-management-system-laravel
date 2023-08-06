<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use App\Models\School;
use App\Models\User;
use PharIo\Manifest\AuthorCollection;

class SchoolsController extends Controller
{
    //

    public function index(){

        $page = "Schools";
        $user = new User();
        $school = new School();
        
        $data = $school->all();

        foreach ($data as $key => $value) {
            $data[$key]->user = DB::table('users')->where("user_id", $data[$key]->user_id)->first();
        }

        //dd($data);
        return view('schools.school',[
            'page'=>$page,
            'rows' =>$data
        ]);
    }

    // add school
    public function add(Request $req){
        $page = "Add School";

        if(count($req->all()) > 0){
            $req->validate([
                'school' => "required|string"
            ]);

            $school = new School();
            $save = $school->insert([
                'school' => $req->input('school'),
                'school_id' => Str::random(),
                'user_id' => $req->session()->get('USERS')->user_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            if($save){
                return redirect('/schools')->with('status', 'New school added!');
            }

            return back()->withErrors('school', 'Something went wrong!');
        }
        return view('schools.add',[
            'page' => $page
        ]);
    }

    // edit
    public function edit(Request $req, $id = ''){

        $page = "Edit School";
        $school = new School();

        if(count($req->all()) > 0){
            $req->validate([
                'school' => "required|string"
            ]);

            $VAR = ['school' => $req->input('school')];

            $save = $school->where('id', $id)->update($VAR);

            if($save){
                return redirect('/schools')->with('status', 'School updated!');
            }

            return back()->withErrors('school', 'Something went wrong!');
        }

        $row = $school->find($id);
        
        return view('schools.edit',[
            'page' => $page,
            'row' => $row
        ]);
    }

    public function delete(Request $req,$id = '')
    {
        $page = "Delete School";
        $school = new School();

        $row = $school->find($id);

        if(count($req->all()) > 0){

            $trash = $row->delete();
            if($trash){
                return redirect('/schools')->with('status', 'School trashed!');
            }

            return back()->withErrors('school', 'Something went wrong!');
        }
        return view('schools.delete',[
            'page' => $page,
            'row' => $row
        ]);
    }

    public function switch(Request $req, $id = '')
    {
        $page = "Switch School";
        
        $school = new School();
        $switch = $school->switch_school($id);
        if($switch){
            return redirect('/schools')->with('status', 'School swtiched!');
        }

        return view('schools.switch',[
            'page' => $page
        ]);
    }

}

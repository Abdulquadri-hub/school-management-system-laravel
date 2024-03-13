<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\DB;
use App\Models\School;
use App\Models\User;
use PharIo\Manifest\AuthorCollection;
use Illuminate\Support\Facades\Auth;

class SchoolsController extends Controller
{
    //

    public function index(){

        $page = "Schools";
        $user = new User();
        $school = new School();
        
        $school_id = session()->get('USERS_ROW')->school_id;
        $data = $school->all();

        foreach ($data as $key => $value) {
            $data[$key]->user = DB::table('users')->where("user_id", $data[$key]->user_id)->first();
        }
        
        if(Rank::hasRank('admin'))       
            return view('schools.school',[
            'page'=>$page,
            'rank' => new Rank(),
            'rows' =>$data
            ]);
        
        else 
            return redirect('/access-denied');
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
                'user_id' => $req->session()->get('USERS_ROW')->user_id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            if($save){
                return redirect('/schools')->with('status', 'New school added!');
            }

            return back()->withErrors('school', 'Something went wrong!');
        }

        if(Rank::hasRank('admin')) 
            return view('schools.add',[
                'rank' => new Rank(),
                'page' => $page
            ]);
        else 
            return redirect('/access-denied');
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
        
        if(Rank::hasRank('admin')) 
            return view('schools.edit',[
                'page' => $page,
                'rank' => new Rank(),
                'row' => $row
            ]);

        else 
            return redirect('/access-denied');
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

        if(Rank::hasRank('admin')) 
            return view('schools.delete',[
                'page' => $page,
                'rank' => new Rank(),
                'row' => $row
            ]);
        else 
            return redirect('/access-denied');
    }

    public function switch(Request $req, $id = '')
    {
        $page = "Switch School";
        
        $school = new School();
        $user = new User();

        $switch = $school->switch_school($id);
        if($switch){
            
            return redirect('/schools')->with('status', 'School swtiched!');
        }
        
        if(Rank::hasRank('super admin'))
            return view('schools.switch',[
                'rank' => new Rank(),
                 'page' => $page
            ]);
        else 
            return redirect('/access-denied');
    }

}

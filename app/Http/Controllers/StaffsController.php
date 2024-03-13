<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;

class StaffsController extends Controller
{
    public function index(Request $req)
    {
        $page = "Staffs";

        $school_id = session()->get('USERS_ROW')->school_id;
        $rows = User::all()->where('rank', '!=', "student")
                    ->where("school_id", $school_id);

        return view('staffs.view',[
            'page' =>$page,
            'rank' => new Rank(),
            'rows' => $rows
        ]);
    }
}

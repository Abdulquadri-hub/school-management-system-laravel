<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StaffsController extends Controller
{
    public function index(Request $req)
    {
        $page = "Staffs";

        $rows = User::all()->where('rank', '!=', "student");

        return view('staffs.view',[
            'page' =>$page,
            'rows' => $rows
        ]);
    }
}

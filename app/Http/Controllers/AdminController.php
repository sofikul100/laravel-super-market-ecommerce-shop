<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index (){
        return view('admin.main_dashboard');
    }

    public function profile(){
        return view('admin.profile');
    }


    public function setting(){
        return view('admin.setting');
    }
}

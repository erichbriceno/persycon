<?php

namespace App\Http\Controllers;


class AdminController extends Controller
{
    public function project()
    {
        return view('admin.project');
    }

    public function management()
    {
        return view('admin.management');
    }

    public function group()
    {
        return view('admin.groups');
    }

    public function user()
    {
        return view('admin.users');
    }
}

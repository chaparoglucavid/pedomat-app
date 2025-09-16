<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        return view('forums.index');
    }

    public function show()
    {
        return view('forums.show');
    }
}
